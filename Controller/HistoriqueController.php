<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class HistoriqueController extends Controller{
    
    public function historique() {
        $this->render('historique', []);
        
    }
}