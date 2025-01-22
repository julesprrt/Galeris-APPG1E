<?php
require_once('Database/Database.php');

class Dashboard
{
    public function __construct() {}

    /**
     * VENTES - Nombre de ventes sur 30 derniers jours, groupées par date
     */
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

    /**
     * TOP VENDEURS - Sur 30 derniers jours
     */
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

    /**
     * PRIX 30 DERNIERES VENTES
     */
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

    /**
     * INSCRIPTIONS DES 30 DERNIERS JOURS
     * On compte le nombre d'utilisateurs créés chaque jour
     */
    public function getInscriptions30DerniersJours(Database $db)
    {
        $conn = $db->connect();
        $query = "
            SELECT DATE(date_creation) AS date_inscription, COUNT(*) AS nb_inscriptions
            FROM utilisateur
            WHERE date_creation >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)
            GROUP BY DATE(date_creation)
            ORDER BY DATE(date_creation) ASC
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    /**
     *  STATUTS DES EXPOSITIONS
     * On compte combien d'expositions sont en 'refuse', 'en attente de validation' ou 'accepte'
     */
    public function getExpositionStatuts(Database $db)
    {
        $conn = $db->connect();
        $query = "
            SELECT statut, COUNT(*) AS total
            FROM exposition
            GROUP BY statut
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }
    public function getVenteStatus(Database $db)
    {
        $conn = $db->connect();
        // On compte combien d'œuvres sont vendues (est_vendu=1) et non vendues (est_vendu=0)
        $query = "
            SELECT est_vendu, COUNT(*) as total
            FROM oeuvre
            GROUP BY est_vendu
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function getVille(Database $db)
    {
        $conn = $db->connect();
        // On récupère les villes depuis la table livraison, avec un COUNT
        $query = "
            SELECT ville, COUNT(*) AS total
            FROM livraison
            WHERE ville IS NOT NULL AND ville != ''
            GROUP BY ville
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result; // mysqli_result
    }

    public function getCategorie(Database $db)
    {
        $conn = $db->connect();
        // Jointure pour compter le nombre d'œuvres par catégorie
        $query = "
            SELECT c.Nom_categorie, COUNT(o.id_oeuvre) as total
            FROM oeuvre o
            JOIN categorie c ON o.id_categorie = c.id_categorie
            GROUP BY c.id_categorie
        ";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result; // mysqli_result
    }

    public function getBoxStats(Database $db)
    {
        $conn = $db->connect();

        // 1) Total revenue (somme de Prix) depuis le début, pour les œuvres vendues
        $queryTotal = "
            SELECT IFNULL(SUM(Prix), 0) AS total_revenue
            FROM oeuvre
            WHERE est_vendu = 1
        ";
        $stmtTotal = $conn->prepare($queryTotal);
        $stmtTotal->execute();
        $resTotal = $stmtTotal->get_result()->fetch_assoc();
        $totalRevenue = $resTotal['total_revenue'] ?? 0;
        $stmtTotal->close();

        // 2) Moyenne des ventes
        $queryAvg = "
            SELECT IFNULL(AVG(Prix), 0) AS avg_price
            FROM oeuvre
            WHERE est_vendu = 1
        ";
        $stmtAvg = $conn->prepare($queryAvg);
        $stmtAvg->execute();
        $resAvg = $stmtAvg->get_result()->fetch_assoc();
        $avgPrice = $resAvg['avg_price'] ?? 0;
        $stmtAvg->close();

        // 3) CA (chiffre d'affaire) du mois en cours
        $queryMonth = "
            SELECT IFNULL(SUM(Prix), 0) AS monthly_revenue
            FROM oeuvre
            WHERE est_vendu = 1
              AND MONTH(Date_fin) = MONTH(CURDATE())
              AND YEAR(Date_fin) = YEAR(CURDATE())
        ";
        $stmtMonth = $conn->prepare($queryMonth);
        $stmtMonth->execute();
        $resMonth = $stmtMonth->get_result()->fetch_assoc();
        $monthlyRevenue = $resMonth['monthly_revenue'] ?? 0;
        $stmtMonth->close();

        $conn->close();

        // On retourne un tableau associatif avec nos stats
        return [
            'total_revenue'   => $totalRevenue,
            'avg_price'       => $avgPrice,
            'monthly_revenue' => $monthlyRevenue
        ];
    }
}
