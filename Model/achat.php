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
}
