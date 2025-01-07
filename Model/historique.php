<?php

require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

Class Historique {
    public function __construct()
    {}
    public function getAllHistorique(Database $db){
        $conn = $db->connect();
        $sql = "SELECT * 
FROM oeuvre o 
LEFT JOIN (
    SELECT id_oeuvre, MIN(chemin_image) AS 'image_path' 
    FROM oeuvre_images 
    GROUP BY id_oeuvre
) oi ON oi.id_oeuvre = o.id_oeuvre
LEFT JOIN vente ON vente.id_oeuvre = o.id_oeuvre
WHERE (o.id_utilisateur = ? AND (statut = ? OR statut = ?) AND o.id_utilisateur = ?)
";
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
