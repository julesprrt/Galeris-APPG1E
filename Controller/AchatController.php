<?php
require_once('Model/enchere.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class AchatController extends Controller{//Controlleur accueil
    
    public function achat(Database $db) {
        $id = $_GET['id'] ?? null ;// si on trouve pas id renvoie rien
        
        if ($id){

            $artModele = new Art();
            $oeuvre = $artModele->getArtById($id,$db);


            if ($oeuvre){
                $this->render('achat',['oeuvre'=> $oeuvre]);
                
            } else {
                $this->render('404',['message'=> 'oeuvre introuvable']);
            
            }

        }

        
    }
}