<?php
require_once('Database/Database.php');

class Oeuvre
{
    private $Titre;
    private $Description;
    private $eco_responsable;
    private $Date_debut;
    private $Date_fin;
    private $Prix;
    private $type_vente;
    private $est_vendu;
    private $auteur;
    private $id_utilisateur;
    private $id_categorie;
    private $status;
    private $nomvendeur;
    private $prenomvendeur;
    private $chemin_image = [];
    private $prix_actuel;
    private $id_offreur;


    // Constructeur pour initialiser les valeurs
    public function __construct(
        $Titre,
        $Description,
        $eco_responsable,
        $Date_debut,
        $Date_fin,
        $Prix,
        $type_vente,
        $est_vendu,
        $auteur,
        $id_utilisateur,
        $id_categorie,
        $status,
        $nomvendeur,
        $prenomvendeur,
        $chemin_image,
        $prix_actuel,
        $id_offreur,



    ) {
        $this->Titre = $Titre;
        $this->Description = $Description;
        $this->eco_responsable = $eco_responsable;
        $this->Date_debut = $Date_debut;
        $this->Date_fin = $Date_fin;
        $this->Prix = $Prix;
        $this->type_vente = $type_vente;
        $this->est_vendu = $est_vendu;
        $this->auteur = $auteur;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_categorie = $id_categorie;
        $this->status = $status;
        $this->nomvendeur = $nomvendeur;
        $this->prenomvendeur = $prenomvendeur;
        $this->chemin_image = $chemin_image;
        $this->prix_actuel = $prix_actuel;
        $this->id_offreur = $id_offreur;
    }
    // Méthode pour récupérer une œuvre par son ID
    public static function getOeuvreById($id, Database $db)
    {
        $conn = $db->connect();
        $query = "SELECT * FROM oeuvre o 
        INNER JOIN utilisateur u ON u.id_utilisateur = o.id_utilisateur 
        LEFT JOIN utilisateur_image ui ON ui.id_utilisateur = o.id_utilisateur
        LEFT JOIN enchere e on e.id_oeuvre_enchere = o.id_oeuvre  
        WHERE o.id_oeuvre = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $oeuvre = $result->fetch_assoc();

        $stmt->close();

        // Récupére les images de l'œuvre 
        $queryImages = "SELECT chemin_image FROM oeuvre_images WHERE id_oeuvre = ?";
        $stmtImages = $conn->prepare($queryImages);
        $stmtImages->bind_param('i', $id);
        $stmtImages->execute();

        $resultImages = $stmtImages->get_result();
        // Récupére les chemins des images
        $chemin_image = [];
        while ($row = $resultImages->fetch_assoc()) {
            $chemin_image[] = $row['chemin_image'];
        }
        $stmtImages->close();
        $conn->close();

        // Ajouter les chemins des images à l'œuvre
        $oeuvre['chemin_image'] = $chemin_image;


        return $oeuvre;
    }
    public static function getAllOeuvre(Database $db)
    {
        $conn = $db->connect();
        $query = " SELECT o.*, oi.chemin_image
        FROM oeuvre o
        INNER JOIN oeuvre_images oi ON o.id_oeuvre = oi.id_oeuvre
        WHERE o.est_vendu = ?
        GROUP BY o.id_oeuvre
        ORDER BY o.Date_fin DESC
        LIMIT 10
    ";




        $stmt = $conn->prepare($query);
        $est_vendu = 0;
        $stmt->bind_param('i', $est_vendu);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        return $result;
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
