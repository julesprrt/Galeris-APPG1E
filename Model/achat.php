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
    private $chemin_image;

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
        $chemin_image

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
    }
    // Méthode pour récupérer une œuvre par son ID
    public static function getOeuvreById($id, Database $db)
    {
        $conn = $db->connect();
        $query = "SELECT * FROM oeuvre o INNER JOIN utilisateur u ON u.id_utilisateur = o.id_utilisateur WHERE id_oeuvre =  ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $oeuvre = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $oeuvre;
    }
    public static function getAllOeuvre(Database $db)
    {
        $conn = $db->connect();
        $query = "SELECT * FROM oeuvre o INNER JOIN oeuvre_images oi ON o.id_oeuvre = oi.id_oeuvre WHERE o.est_vendu = ? ORDER BY Date_fin DESC LIMIT 10";

        $stmt = $conn->prepare($query);
        $est_vendu = 0;
        $stmt->bind_param('i', $est_vendu);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        return $result;
    }
    public static function getImagesByOeuvreId($id_oeuvre, Database $db) 
{
    // Connexion à la base de données
    $conn = $db->connect();

    // Requête SQL pour récupérer les images liées à une œuvre spécifique
    $query = "SELECT chemin_image FROM oeuvre_images WHERE id_oeuvre = ?";

    // Préparer la requête
    $stmt = $conn->prepare($query);

    // Associer le paramètre à la requête (id de l'œuvre)
    $stmt->bind_param('i', $id_oeuvre);

    // Exécuter la requête
    $stmt->execute();

    // Obtenir les résultats
    $result = $stmt->get_result();

    // Stocker les résultats dans un tableau
    $images = [];
    while ($row = $result->fetch_assoc()) {
        $images[] = $row['chemin_image'];
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();

    // Retourner les images
    return $images;
}

}
