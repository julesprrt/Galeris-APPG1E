<?php


require_once('Constantes/constants.php');
require_once('Database/Database.php');

class Categorie
{

    public function __construct()
    {//Constructeur -> Initialisation des données

    }

    public function getAllCategorie(Database $db)
    {
        $Database = $db->connect();
        $sql = "Select id_categorie, Nom_categorie from categorie";
        $stmt = $Database->prepare($sql);
        $stmt->execute();
        $result = [];
        $stmt->bind_result($id_categorie,$Nom_categorie);
        while ($stmt->fetch()) {
            $result[] = [
                "nom" => $Nom_categorie,
                "id" => $id_categorie
            ];
        }

        $stmt->fetch();
        $stmt->close();
        $Database->close();
        return $result;
    }



}
