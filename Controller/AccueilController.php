<?php
require_once('../Model/inscription.php');
require_once('../Database/Database.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    PostUser();
    echo json_encode(['status' => 'succés', 'message' => 'Utilisateur ajouté']);
} else {
    echo json_encode(['status' => 'erreur', 'message' => 'erreur']);
}