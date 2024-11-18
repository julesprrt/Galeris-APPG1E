<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');

//Controller utilisateur
Class UserController extends Controller{
    
    public function inscription(Database $db) {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data['name']) && isset($data['firstName']) && isset($data['userName']) && isset($data['email']) && isset($data['telephone']) && isset($data['password']) && isset($data['confirmPassword'])){//Verification données entré dans le formulaire
            $user = new User($data["name"], $data["firstName"], $data["userName"], $data["email"], $data["telephone"], $data["password"],$data["confirmPassword"]);
            $result = $user->registerVerification($db);//Verifier les données d'inscription
            if($result === true){//Si les données sont correct alors envoie du code a usage unique + redirection vers la page  avec le code à usage unique
                //$user->saveUser($db);
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail"]);
                //Envoie code à usage unique
                //Redirection vers la page avec le code à usage unique
                //$this->render('code', ['message' => $user->"Un code vous à été envoyé sur votre adresse mail"]);
            }
            else{//Sinon affiché le message d'erreur sur la vue
                http_response_code(400);
                echo json_encode(['Error' => $result]);
            }
        }
        else{//Premier affichage sans les données Post
            $this->render('inscription', ['message' => '']);
        }
    }

    //Connexion de l'utilisateur
    public function connexion(Database $db) {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['email']) && isset($data['password'])) {
            $user = new User(null,null,null,$data['email'], null,$data['password'], null);
            // Obtenir une connexion à la base de données
            $result = $user-> connectUser($db);
            if($result === true){
                http_response_code(200);
                echo json_encode(['Success' => "Connexion réussie"]);
            }
            else{
                http_response_code(400);
                echo json_encode(['Error' => $result]);
            }
        }
        else{
            $this->render('connexion', ['message' => '']);
        }
    }

    public function password(Database $db){
        $this->render('motdepasseoublie', ['message' => '']);
    }
}

