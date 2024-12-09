<?php 
require_once('Database/Database.php');
require_once('Model/utils.php');

class Oeuvre  {

    private $id_artwork;
    private $id_user;
    private $title; 
    private $description;
    private $image_url; 
    private $eco_friendly;
    private $price;
    private $sale_type;
    private $start_date;  
    private $end_date;


    public function __construct($id_artwork,$id_user,$title,$description,$image_url,$eco_friendly,$price,$sale_type,$start_date,$end_date){

        
        $this->id_artwork = $id_artwork;
        $this->id_user = $id_user;
        $this->title = $title;
        $this->description = $description;
        $this->image_urel = $image_url;
        $this->eco_friendly = $eco_friendly;
        $this->price = $price;
        $this->sale_type = $sale_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        
    }

     public function connectOeuvre(Database $db){

        $database = $db->connect();
        





     }
    
}

?>