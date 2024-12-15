<?php
require_once('Database/Database.php');

class Oeuvre
{
    private $titre;
    private $description;
    private $dimensions;
    private $prix;
    private $ecoInfo;
    private $datePublication;
    private $vendeurId;

    // Constructeur pour initialiser les valeurs
    public function __construct($titre, $description, $dimensions, $prix, $ecoInfo, $vendeurId, $datePublication = null)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->dimensions = $dimensions;
        $this->prix = $prix;
        $this->ecoInfo = $ecoInfo;
        $this->vendeurId = $vendeurId;
        $this->datePublication = $datePublication ?? date('Y-m-d'); // Par défaut, date actuelle
    }
    // Méthode pour récupérer une œuvre par son ID
    public static function getOeuvreById($id, Database $db)
    {
        $conn = $db->connect();
        $query = "SELECT * FROM oeuvres WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $oeuvre = $result->fetch_assoc();

        $stmt->close();
        $conn->close();

        return $oeuvre;
    }
}
