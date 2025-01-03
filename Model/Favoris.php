<?php
require_once __DIR__ . '/../Database/Database.php';
require_once __DIR__ . '/../Model/Oeuvre.php';


 
class Favoris
{
    
    public function isFavoris($idUtilisateur, $idOeuvre, Database $db)
    {
        $conn = $db->connect();
        $sql = "SELECT favoris FROM utilisateur WHERE id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idUtilisateur);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $conn->close();

        if (!$result || empty($result['favoris'])) {
            return false;
        }

    
        $favorisArray = explode(',', $result['favoris']);

       
        return in_array($idOeuvre, $favorisArray);
    }

   
    public function addFavoris($idUtilisateur, $idOeuvre, Database $db)
    {
       
        if ($this->isFavoris($idUtilisateur, $idOeuvre, $db)) {
            return; 
        }

        $conn = $db->connect();

       
        $sqlSelect = "SELECT favoris FROM utilisateur WHERE id_utilisateur = ?";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bind_param("i", $idUtilisateur);
        $stmtSelect->execute();
        $row = $stmtSelect->get_result()->fetch_assoc();
        $stmtSelect->close();

        $oldFavoris = $row ? $row['favoris'] : "";
        $newFavoris = "";

        if (empty($oldFavoris)) {
          
            $newFavoris = $idOeuvre;
        } else {
          
            $newFavoris = $oldFavoris . "," . $idOeuvre;
        }

        
        $sqlUpdate = "UPDATE utilisateur SET favoris = ? WHERE id_utilisateur = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("si", $newFavoris, $idUtilisateur);
        $stmtUpdate->execute();
        $stmtUpdate->close();
        $conn->close();
    }

   
    public function removeFavoris($idUtilisateur, $idOeuvre, Database $db)
    {
        
        if (!$this->isFavoris($idUtilisateur, $idOeuvre, $db)) {
            return;
        }

        $conn = $db->connect();
        
        $sqlSelect = "SELECT favoris FROM utilisateur WHERE id_utilisateur = ?";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bind_param("i", $idUtilisateur);
        $stmtSelect->execute();
        $row = $stmtSelect->get_result()->fetch_assoc();
        $stmtSelect->close();

        if ($row && !empty($row['favoris'])) {
            $favorisArray = explode(',', $row['favoris']);
            
            $favorisArray = array_filter($favorisArray, function($value) use ($idOeuvre){
                return $value != $idOeuvre;
            });
            
            $newFavoris = implode(',', $favorisArray);

            
            $sqlUpdate = "UPDATE utilisateur SET favoris = ? WHERE id_utilisateur = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("si", $newFavoris, $idUtilisateur);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        }
        $conn->close();
    }

    
    public function getUserFavoris($idUtilisateur, Database $db)
    {
        $conn = $db->connect();
        $sql = "SELECT favoris FROM utilisateur WHERE id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idUtilisateur);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$row || empty($row['favoris'])) {
            
            $conn->close();
            return [];
        }

        $favorisArray = explode(',', $row['favoris']);

       
        $placeholders = implode(',', array_fill(0, count($favorisArray), '?'));
        $sqlOeuvre = "
            SELECT o.*, 
                   (SELECT chemin_image 
                    FROM oeuvre_images 
                    WHERE oeuvre_images.id_oeuvre = o.id_oeuvre 
                    LIMIT 1) AS chemin_image,
                   u.nom AS vendeur_nom,
                   u.prenom AS vendeur_prenom
            FROM oeuvre o
            INNER JOIN utilisateur u ON u.id_utilisateur = o.id_utilisateur
            WHERE o.id_oeuvre IN ($placeholders)
        ";

        $stmtOeuvre = $conn->prepare($sqlOeuvre);

        
        $types = str_repeat("i", count($favorisArray));
        $stmtOeuvre->bind_param($types, ...$favorisArray);

        $stmtOeuvre->execute();
        $result = $stmtOeuvre->get_result();

        $oeuvres = [];
        while ($oeuvre = $result->fetch_assoc()) {
            $oeuvres[] = $oeuvre;
        }

        $stmtOeuvre->close();
        $conn->close();

        return $oeuvres;
    }
}
