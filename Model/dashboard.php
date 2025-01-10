<?php
require_once('Database/Database.php');

class Dashboard

{
    public function __construct() {}

    public function getVentes30DerniersJours(Database $db)
    {
        $conn = $db->connect();
        $query = "
        SELECT COUNT(*) as nombre_ventes, DATE(Date_fin) as date_vente
        FROM oeuvre
        WHERE Date_fin >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        GROUP BY DATE(Date_fin)
    ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getTopVendeurs(Database $db)
    {
        $conn = $db->connect();
        $query = "
        SELECT u.nom, u.prenom, COUNT(o.id_oeuvre) as nombre_ventes
        FROM utilisateur u
        JOIN oeuvre o ON u.id_utilisateur = o.id_utilisateur
        WHERE o.Date_fin >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        GROUP BY u.id_utilisateur
        ORDER BY nombre_ventes DESC
        LIMIT 10
    ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getPrix30DernieresVentes(Database $db)
    {
        $conn = $db->connect();
        $query = "
        SELECT o.Titre, o.Prix, o.type_vente, o.Date_fin
        FROM oeuvre o
        WHERE o.Date_fin >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
        ORDER BY o.Date_fin DESC
        LIMIT 30
    ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }
}
