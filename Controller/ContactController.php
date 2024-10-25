<?php
require_once('Database/Database.php');
require_once('Controller.php');

//Controller utilisateur
Class ContactController extends Controller{
    
    public function contact(Database $db) {
            $this->render('contact', ['message' => '']);
    }
}