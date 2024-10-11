<?php

require_once('../Database/Database.php');

function PostUser(){
    $sql = "INSERT INTO utilisateur (nom, prenom, email, description, adresse, roles, mot_de_passe, date_creation, newsletter)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $db = connect();
    $stmt = $db->prepare($sql);


    $stmt->bind_param('sssssssss', $nom, $prenom, $email, $description, $adresse, $roles, $mot_de_passe, $date_creation, $newsletter);
    
   $stmt->execute();
}