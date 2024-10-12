<?php
require_once('../Database/Database.php');

/**
 * Summary of PostUser
 * Méthode permettant d'ajouter un utilisateur dans la BD (Fonction de test)
 * @param Database $database
 * @return void
 */
function PostUser(Database $database){
    $sql = "INSERT INTO utilisateur (nom, prenom, adresse, roles, mot_de_passe, date_creation, newsletter)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $db = $database->connect();
    $stmt = $db->prepare($sql);

    $nom = 'test';
    $prenom = 'test';
    $email = 'test@gmail.com';
    $roles = 'FALSE';
    $mot_de_passe = 'test';
    $date_creation = '2024-02-03';
    $newsletter = 'TRUE';

    $stmt->bind_param('sssssss',$nom, $prenom, $email, $roles, $mot_de_passe, $date_creation, $newsletter);
    
    $stmt->execute();
}