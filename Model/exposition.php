<?php

require_once('Constantes/constants.php');
require_once('Database/Database.php');

class Exposition
{
    private $titre;
    private $date_debut;
    private $date_fin;
    private $description;

    public function __construct($titre, $date_debut, $date_fin, $description)
    {
        $this->titre = $titre;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->description = $description;
    }

    public function VerifyAndSaveExposition(Database $db)
    {
        if ($this->titre === "" || strlen($this->titre) > 50) {
            return 401;
        }
        if ($this->date_debut === "") {
            return 402;
        }
        if ($this->date_fin === "") {
            return 403;
        }
        return $this->saveExposition($db);

    }
    public function VerificationDate($date_debut)
    {
        $date_fin = date('Y/m/d');
        if ($date_debut < $date_fin) {
            return false;
        } else {
            return true;
        }
    }

    public function saveExposition(Database $db)
    {
        session_start();
        $Database = $db->connect();
        $sql = "insert into exposition (titre,description,date_debut,date_fin,user_id) values (?,?,?,?,?)";
        $stmt = $Database->prepare($sql);
        $stmt->bind_param('ssssi', $this->titre, $this->description, $this->date_debut, $this->date_fin, $_SESSION["user_id"]);
        $stmt->execute();
        $stmt->close();
        $Database->close();
        return 200;
    }
}
