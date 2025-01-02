<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class MentionsLegalesController extends Controller{//Controlleur accueil
    
    public function mentionslegales() {
        $this->render('MentionsLegales', []);
        
    }
}