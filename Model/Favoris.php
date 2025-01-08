<?php

require_once('Constantes/constants.php');
require_once('Database/Database.php');

Class Favoris{
    public function __construct() {//Constructeur -> Initialisation des données
       
    }

    public function existFavoris(Database $db){
        $conn = $db->connect();
        $sql = "select * from favoris where id_utilisateur = ? and id_oeuvre= ?";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $id_oeuvre =  $_SESSION['oeuvre_id'];
        $stmt->bind_param("ii", $id_utilisateur, $id_oeuvre);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if(mysqli_num_rows($result) > 0){
            return true;
        }
        return false;
    }

    public function ajoutFavoris(Database $db) {
        session_start();
        $res = $this->existFavoris($db);
        if($res){
            return 401;
        }
        $conn = $db->connect();
        $sql = "insert into favoris (id_utilisateur, id_oeuvre) values (?,?)";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $id_oeuvre =  $_SESSION['oeuvre_id'];
        $stmt->bind_param("ii", $id_utilisateur, $id_oeuvre);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return 200;
    }

    public function retirerFavoris(Database $db) {
        session_start();
        $res = $this->existFavoris($db);
        if(!$res){
            return 401;
        }
        $conn = $db->connect();
        $sql = "Delete from favoris where id_utilisateur = ? and id_oeuvre = ?";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $id_oeuvre =  $_SESSION['oeuvre_id'];
        $stmt->bind_param("ii", $id_utilisateur, $id_oeuvre);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return 200;
    }

    
    public function retirerFavorisID(Database $db, $id) {
        $conn = $db->connect();
        $sql = "Delete from favoris where id_favoris = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return 200;
    }

    public function getAllFavoris(Database $db){
        session_start();
        $conn = $db->connect();
        
       
        $sql = "SELECT * 
                FROM favoris f
                INNER JOIN oeuvre o ON o.id_oeuvre = f.id_oeuvre 
                INNER JOIN utilisateur u ON u.id_utilisateur = o.id_utilisateur
                LEFT JOIN oeuvre_images oi ON oi.id_oeuvre = o.id_oeuvre
                WHERE f.id_utilisateur = ? 
                  AND o.type_vente = ? 
                  AND o.est_vendu = ? 
                  AND o.Date_fin > ?
                GROUP BY o.id_oeuvre";
    
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $type_vente = "vente";
        $est_vendu = 0;
        $actualDate = date('Y-m-d H:i:s');
    
        $stmt->bind_param("isis", $id_utilisateur, $type_vente, $est_vendu, $actualDate);
        $stmt->execute();
        $result = $stmt->get_result();
        $favoris = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
    }
}