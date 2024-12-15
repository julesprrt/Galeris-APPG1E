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
        if ($this->date_debut === "" || $this->VerificationDate($this->date_debut) === false) {
            return 402;
        }
        if ($this->date_fin === "") {
            return 403;
        }
        if($this->getNumberDaysBeetweenTwoDates() > 14){
            return 404;
        }
        $this->saveExposition($db);
        if($this->image1 !== ""){
            $this->SaveExpositionFile($db, $this->image1);
        }
        if($this->image2 !== ""){
            $this->SaveExpositionFile($db, $this->image1);
        }
        if($this->image3 !== ""){
            $this->SaveExpositionFile($db, $this->image1);
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
        session_start();
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
}
