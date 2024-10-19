<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');

//Controller utilisateur
Class UserController extends Controller{
    
    public function inscription(Database $db) {
        if(isset($_POST['name']) && isset($_POST['firstName']) && isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){//Verification données entré dans le formulaire
            $user = new User($_POST["name"], $_POST["firstName"], $_POST["userName"], $_POST["email"], $_POST["telephone"], $_POST["password"],$_POST["confirmPassword"]);
            $result = $user->registerVerification($db);//Verifier les données d'inscription
            if($result === true){//Si les données sont correct alors envoie du code a usage unique + redirection vers la page  avec le code à usage unique
                echo "Parfait";
                //Envoie code à usage unique
                //Redirection vers la page avec le code à usage unique
                //$this->render('code', ['message' => $user->"Un code vous à été envoyé sur votre adresse mail"]);
            }
            else{//Sinon affiché le message d'erreur sur la vue
                $this->render('inscription', ['message' => $user->registerVerification($db)]);
            }
        }
        else{//Premier affichage sans les données Post
            $this->render('inscription', ['message' => '']);
        }
    }
}