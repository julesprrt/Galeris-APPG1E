<?php
require_once('Model/enchere.php');
require_once('Database/Database.php');
require_once('Controller.php');

Class EnchereController extends Controller {


    public function oeuvre(){
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
    }


}
?>