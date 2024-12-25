<?php

require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

Class Panier{
    public function __construct() {//Constructeur -> Initialisation des données
       
    }

    public function existPanier(Database $db){
        $conn = $db->connect();
        $sql = "select * from panier where id_utilisateur = ? and id_oeuvre= ?";
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

    public function ajoutPanier(Database $db) {
        session_start();
        $res = $this->existPanier($db);
        if($res){
            return 401;
        }
        $conn = $db->connect();
        $sql = "insert into panier (id_utilisateur, id_oeuvre) values (?,?)";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $id_oeuvre =  $_SESSION['oeuvre_id'];
        $stmt->bind_param("ii", $id_utilisateur, $id_oeuvre);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return 200;
    }

    public function retirerPanier(Database $db) {
        session_start();
        $res = $this->existPanier($db);
        if(!$res){
            return 401;
        }
        $conn = $db->connect();
        $sql = "Delete from panier where id_utilisateur = ? and id_oeuvre = ?";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $id_oeuvre =  $_SESSION['oeuvre_id'];
        $stmt->bind_param("ii", $id_utilisateur, $id_oeuvre);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return 200;
    }
    
}
