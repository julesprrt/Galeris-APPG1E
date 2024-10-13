<?php
require_once('../Model/inscription.php');
require_once('../Database/Database.php');

/**
 * Controller test qui détecter les API Post sur notre app 
 * et qui appel dans ce cas la methode PostUser permettant d'ajouter un utilisateur dans la BD
 */
$database = new Database();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    PostUser($database);
    echo json_encode(['status' => 'succés', 'message' => 'Utilisateur ajouté']);
} else {
    echo json_encode(['status' => 'erreur', 'message' => 'erreur']);
}