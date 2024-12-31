<?php

require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

Class Livraison{
    private $nom;
    private $prenom;
    private $pays;
    private $adresse;
    private $codePostale;
    private $ville;

    public function __construct($nom, $prenom, $pays, $adresse, $codePostale, $ville) {//Constructeur -> Initialisation des données
       $this->nom = $nom;
       $this->prenom = $prenom;
       $this->pays = $pays;
       $this->adresse = $adresse;
       $this->codePostale = $codePostale;
       $this->ville = $ville; 
    }


    public function saveLivraison(Database $db){
        session_start();

        if(!ctype_alpha($this->nom)){
            return 401;
        }

        if(!ctype_alpha($this->prenom)){
            return 402;
        }

        if(!ctype_alpha($this->pays)){
            return 403;
        }

        if(!ctype_alpha($this->ville)){
            return 404;
        }

        $res = $this->verifyExistLivraison($db, $_SESSION["usersessionID"]);
        if($res === true){
            $this->updateLivraison($db, $_SESSION["usersessionID"]);
            return 200;
        }
        else{
            $this->insertLivraison($db, $_SESSION["usersessionID"]);
            return 200;
        }
    }

    public function verifyExistLivraison(Database $db, $id){
        $conn = $db->connect();
        $sql = "select * from livraison where id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        if(mysqli_num_rows($result) > 0){
            return true;
        }
        else{
            return false;
        }
    }


    public function getLivraison(Database $db){
        $conn = $db->connect();
        $sql = "select * from livraison where id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $id = $_SESSION["usersessionID"];
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $res = $result->fetch_assoc(); 
        $stmt->close();
        $conn->close();
        return $res;
    }

    public function insertLivraison(Database $db, $id){
        $conn = $db->connect();
        $sql = "insert into livraison (nom, prenom,pays, adresse, codepostale, ville, id_utilisateur) values (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi",$this->nom,$this->prenom,$this->pays,$this->adresse,$this->codePostale,$this->ville, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function updateLivraison(Database $db, $id){
        $conn = $db->connect();
        $sql = "update livraison set nom = ?, prenom = ?, pays = ?, adresse = ?, codepostale = ?, ville = ? where id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi",$this->nom,$this->prenom,$this->pays,$this->adresse,$this->codePostale,$this->ville, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}
