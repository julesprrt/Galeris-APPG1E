<?php
require_once('Database/Database.php');

class Favoris {
    // 1) Déterminer si un utilisateur a collecté une œuvre
    public static function isFavori($idOeuvre, $idUser, Database $db) {
        $conn = $db->connect();
        $query = "SELECT COUNT(*) AS cnt FROM favoris WHERE id_oeuvre=? AND id_utilisateur=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $idOeuvre, $idUser);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        
        return $row['cnt'] > 0; // S'il est >0, cela signifie qu'il a été collecté.
    }

    // 2) Ajouter à favoris
    public static function addFavori($idOeuvre, $idUser, Database $db) {
        $conn = $db->connect();
        $query = "INSERT INTO favoris (id_oeuvre, id_utilisateur) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $idOeuvre, $idUser);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    // 3) delete from favoris
    public static function removeFavori($idOeuvre, $idUser, Database $db) {
        $conn = $db->connect();
        $query = "DELETE FROM favoris WHERE id_oeuvre=? AND id_utilisateur=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $idOeuvre, $idUser);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    // 4) Obtenir toutes les œuvres collectées d'un utilisateur
    
    public static function getFavorisByUser($idUser, Database $db) {
        $conn = $db->connect();
      
        $query = "
            SELECT o.*, oi.chemin_image
            FROM favoris f
            INNER JOIN oeuvre o ON f.id_oeuvre = o.id_oeuvre
            LEFT JOIN oeuvre_images oi ON o.id_oeuvre = oi.id_oeuvre
            WHERE f.id_utilisateur = ?
            GROUP BY o.id_oeuvre
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $idUser);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();

        return $result; 
    }
}
