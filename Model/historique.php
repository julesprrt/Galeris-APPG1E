<?php

require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

Class Historique {
    public function __construct()
    {}
    public function getAllHistorique(Database $db){
        $conn = $db->connect();
        $sql = "select * from oeuvre where id_utilisateur = ? and statut = ? or statut = ? and id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];   
        $statut = "accepte";
        $statutenattente = "en attente de validation";
        $stmt->bind_param("issi",$id_utilisateur,$statut, $statutenattente,$id_utilisateur);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;

}}
