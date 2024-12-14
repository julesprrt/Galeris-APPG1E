<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/exposition.php');

class ExpositionController extends Controller{ 
    public function exposition()
    {
        $this->render('exposition', []);
    }
    public function createexposition(Database $db){
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data['titre'])&& isset($data['date_debut'])&& isset($data['date_fin'])){
            $exposition=new Exposition($data['titre'],$data['date_debut'],$data['date_fin'],$data['description']);
            $result = $exposition->VerifyAndSaveExposition($db);
            if($result===200){
                http_response_code(200);
                echo json_encode(['Success' => "Les données ont bien été envoyées."]);
            }
            else if($result===401){
                http_response_code(401);
                echo json_encode(['Error' => "Le titre est obligatoire et doit contenir moins de 50 caractères."]);
            }
            else if($result===402){
                http_response_code(402);
                echo json_encode(['Error'=> "La date de début est requise et doit être ultérieure à la date actuelle."]);
            }
            else if($result===403){
                http_response_code(403);
                echo json_encode(['Error'=> "La date de fin est requise."]);
            }
            else if($result === 404){
                http_response_code(404);
                echo json_encode(['Error'=> "La durée maximale est de deux semaines."]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Votre demande d'exposition à bien été pris en compte"]);
        }
    }
}