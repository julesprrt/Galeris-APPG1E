<?php

require_once('Model/utils.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

class Vente
{
    private $titre;
    private $auteur;
    private $categorie;
    private $type_vente;
    private $prix;
    private $nbJours;
    private $description;
    private $image1;
    private $image2;
    private $image3;
    private $choix_eco;
    private $file_eco;
    private Utils $utils;
    public function __construct($titre, $auteur, $categorie, $type_vente, $prix, $nbJours, $description, $image1, $image2, $image3, $choix_eco, $file_eco)
    { //Constructeur -> Initialisation des données
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->categorie = $categorie;
        $this->type_vente = $type_vente;
        $this->prix = $prix;
        $this->nbJours = $nbJours;
        $this->description = $description;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->choix_eco = $choix_eco;
        $this->file_eco = $file_eco;
        $this->utils = new Utils();
    }

    public function VerifyAndSaveProduct(Database $db)
    {
        if ($this->titre === "") {
            return "Le titre est obligatoire";
        } else if ($this->categorie === "") {
            return "La categorie est obligatoire";
        } else if (strlen($this->description) < 50) {
            return "La description est obligatoire et doit contenir plus de 50 caractères.";
        } else if($this->choix_eco === ""){
            return "Choix eco-responsable obligatoire";
        }else if($this->choix_eco === "Oui" && $this->file_eco === ""){
            return "Le fichier éco-responsable est obligatoire"; 
        } else if ($this->image1 === "") {
            return "Vous devez ajouter au moins une image";
        } else if ($this->type_vente === "") {
            return "Le type de vente est obligatoire";
        } else if ($this->prix === "") {
            return "Le prix est obligatoire";
        } else if ($this->nbJours === "" || (int)$this->nbJours > 30) {
            return "Le nombre de jours est obligatoire et doit être inférieur ou égal à 30 jours";
        } else if ($this->image1 !== "" && !$this->utils->verifyImageAndSize($this->image1) || $this->image2 !== "" && !$this->utils->verifyImageAndSize($this->image2) || $this->image3 !== "" && !$this->utils->verifyImageAndSize($this->image3)) {
            return "Type de fichier autorisé : image";
        } else if ($this->image1 !== "" && $this->utils->human_filesize($this->image1) >= 2 || $this->image2 !== "" && $this->utils->human_filesize($this->image2) >= 2 || $this->image3 !== "" && $this->utils->human_filesize($this->image3) >= 2) {
            return "Fichier trop lourd, 2 MB maximum";
        } else if($this->choix_eco === "Oui" && $this->utils->human_filesize($this->file_eco) >= 2){
            return "Fichier trop lourd, 2 MB maximum";
        }
        else {
            $eco_responsable = $this->choix_eco === "Oui" ? 1 : 0;
            $this->saveProduct($db, $eco_responsable);
            if ($this->image1 !== "") {
                $this->saveImage($db, $this->image1);
            }
            if ($this->image2 !== "") {
                $this->saveImage($db, $this->image2);
            }
            if ($this->image3 !== "") {
                $this->saveImage($db, $this->image3);
            }
            if($this->file_eco !== ""){
                $this->savePdfFile($db, $this->file_eco);
            }
            return 200;
        }
    }

    public function saveProduct(Database $db, $eco_responsable)
    {
        $Database = $db->connect();
        $sql = "insert into oeuvre (Titre, Description, Date_fin, Prix, type_vente, auteur, id_utilisateur, id_categorie, eco_responsable) values (?,?,?,?,?,?,?,?,?)";
        $stmt = $Database->prepare($sql);
        $datefin = date('Y-m-d H:i:s', strtotime("+{$this->nbJours} days"));
        $categId = (int)$this->categorie;
        $stmt->bind_param("sssdssiii", $this->titre, $this->description, $datefin, $this->prix, $this->type_vente, $this->auteur,  $_SESSION["usersessionID"], $categId, $eco_responsable);
        $stmt->execute();
        $_SESSION["oeuvre_id"] = $Database->insert_id;
        $stmt->close();
        $Database->close();
    }

    public function saveImage(Database $db, $image)
    {
        $filename = $this->utils->saveFile($image, "Oeuvre");
        $Database = $db->connect();
        $sql = "insert into oeuvre_images (chemin_image, id_oeuvre) values (?,?)";
        $stmt = $Database->prepare($sql);
        $stmt->bind_param("si", $filename, $_SESSION["oeuvre_id"]);
        $stmt->execute();
        $stmt->close();
        $Database->close();
    }

    public function savePdfFile(Database $db, $file){
        $filename = $this->utils->saveFileEco($file, "Oeuvre-file");
        $Database = $db->connect();
        $sql = "insert into oeuvre_file (chemin_fichier, id_oeuvre) values (?,?)";
        $stmt = $Database->prepare($sql);
        $stmt->bind_param("si", $filename, $_SESSION["oeuvre_id"]);
        $stmt->execute();
        $stmt->close();
        $Database->close();
    }
}
