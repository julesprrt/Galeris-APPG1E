<?php

require_once('Constantes/constants.php');
require_once('Database/Database.php');

class Exposition
{
    private $titre;
    private $date_debut;
    private $date_fin;
    private $description;
    private $image1;
    private $image2;
    private $image3;
    private Utils $utils;
    public function __construct($titre, $date_debut, $date_fin, $description, $image1,$image2,$image3)
    {
        $this->titre = $titre;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->description = $description;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->utils = new Utils();
    }

    public function VerifyAndSaveExposition(Database $db)
    {
        if ($this->titre === "" || strlen($this->titre) > 50) {
            return 401;
        }
        if(strlen($this->description) < 50){
            return 405;
        }
        if ($this->date_debut === "" || $this->VerificationDate($this->date_debut) === false) {
            return 402;
        }
        if ($this->date_fin === "") {
            return 403;
        }
        if($this->getNumberDaysBeetweenTwoDates() > 14){
            return 404;
        }
        if($this->image1 === ""){
            return 406;
        }
        else if($this->image1 !== "" && !$this->utils->verifyImageAndSize($this->image1) || $this->image2 !== "" && !$this->utils->verifyImageAndSize($this->image2) || $this->image3 !== "" && !$this->utils->verifyImageAndSize($this->image3)){
            return 407;
        }
        else if($this->image1 !== "" && $this->utils->human_filesize( $this->image1) >= 1 || $this->image2 !== "" && $this->utils->human_filesize($this->image2) >= 1 || $this->image3 !== "" && $this->utils->human_filesize($this->image3) >= 1){
            return 408;
        }
        $this->saveExposition($db);
        if($this->image1 !== ""){
            $this->SaveExpositionFile($db, $this->image1);
        }
        if($this->image2 !== ""){
            $this->SaveExpositionFile($db, $this->image2);
        }
        if($this->image3 !== ""){
            $this->SaveExpositionFile($db, $this->image3);
        }
        return 200;
    }
    public function VerificationDate($date_debut)
    {
        $date_now = new DateTime();
        $date2 = new DateTime($date_debut);

        if ($date2 < $date_now) {
            return false;
        } else {
            return true;
        }
    }

    public function getNumberDaysBeetweenTwoDates()
    {
        $date_debubFormat = strtotime($this->date_debut);
        $date_finFormat = strtotime($this->date_fin);
        $datediff = $date_finFormat - $date_debubFormat;

        return round($datediff / (60 * 60 * 24));
    }

    public function saveExposition(Database $db)
    {
        $Database = $db->connect();
        $sql = "insert into exposition (titre,description,date_debut,date_fin,user_id) values (?,?,?,?,?)";
        $stmt = $Database->prepare($sql);
        $stmt->bind_param('ssssi', $this->titre, $this->description, $this->date_debut, $this->date_fin, $_SESSION["usersessionID"]);
        $stmt->execute();
        $_SESSION["exposition_id"] = $Database->insert_id;
        $stmt->close();
        $Database->close();
    }

    public function SaveExpositionFile(Database $db, $image){
        $filename = $this->utils->SaveFile($image, "exposition");
        $Database = $db->connect();
        $sql = "insert into exposition_images (chemin_image, id_exposition) values (?,?)";
        $stmt = $Database->prepare($sql);
        $stmt->bind_param("si",$filename,$_SESSION["exposition_id"]);
        $stmt->execute();
        $stmt->close();
        $Database->close();
    }

    public function getExposesEnAttente(Database $db){
        $Database = $db->connect();
        $sql = "SELECT e.*, e.description as 'desc', u.*, COALESCE(oi.image_path, 'Aucune image') as 'image_path' FROM exposition e INNER join utilisateur u on u.id_utilisateur = e.user_id LEFT JOIN ( SELECT id_exposition, MIN(chemin_image) as 'image_path' FROM exposition_images GROUP BY id_exposition ) oi ON oi.id_exposition = e.id_exhibition WHERE e.statut = ?";
        $stmt = $Database->prepare($sql);
        $accept = "en attente de validation";
        $stmt->bind_param("s", $accept);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $Database->close();
        return $result;
    }

    public function getExposes(Database $db){
        $Database = $db->connect();
        $sql = "SELECT e.*, e.description as 'desc', u.*, COALESCE(oi.image_path, 'Aucune image') as 'image_path' FROM exposition e INNER join utilisateur u on u.id_utilisateur = e.user_id LEFT JOIN ( SELECT id_exposition, MIN(chemin_image) as 'image_path' FROM exposition_images GROUP BY id_exposition ) oi ON oi.id_exposition = e.id_exhibition WHERE e.statut = ? AND e.Date_fin >= ? Order by date_debut";
        $stmt = $Database->prepare($sql);
        $accept = "accepte";
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        $stmt->bind_param("ss", $accept,$now);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $Database->close();
        return $result;
    }

    public function getExposeById($id, Database $db){
        $conn = $db->connect();
        $query = "SELECT e.*, u.*, e.description as 'desc' FROM exposition e INNER JOIN utilisateur u ON u.id_utilisateur = e.user_id WHERE id_exhibition = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $oeuvre = $result->fetch_assoc();

        $timestamp = strtotime($oeuvre["date_debut"]);
        $date_deb_only = date('d/m/Y', $timestamp);
        $oeuvre["date_debut"] = $date_deb_only;

        $timestamp = strtotime($oeuvre["date_fin"]);
        $date_fin_only = date('d/m/Y', $timestamp);
        $oeuvre["date_fin"] = $date_fin_only;

        $stmt->close();

        // Récupére les images de l'œuvre 
        $queryImages = "SELECT chemin_image FROM exposition_images WHERE id_exposition = ?";
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

    public function updateStatut(Database $db, $accept, $id){
        $Database = $db->connect();
        $sql = "Update exposition set statut = ? where id_exhibition = ?";
        $statut = $accept === true ? "accepte" : "refuse";
        $stmt = $Database->prepare($sql);
        $realID = (int)$id;
        $stmt->bind_param("si",$statut,$realID);
        $stmt->execute();
        $stmt->close();
        $Database->close();
    }
}
