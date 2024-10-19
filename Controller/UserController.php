<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');
Class UserController extends Controller{
    
    public function inscription() {
        if(isset($_POST['name']) && isset($_POST['firstName']) && isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
            $user = new User($_POST["name"], $_POST["firstName"], $_POST["userName"], $_POST["email"], $_POST["telephone"], $_POST["password"],$_POST["confirmPassword"]);
            $result = $user->registerVerification();
            if($result === true){
                echo "Parfait";
                //Redirection vers la page avec le code à usage unique
                //$this->render('code', ['message' => $user->"Un code vous à été envoyé sur votre adresse mail"]);
            }
            else{
                $this->render('inscription', ['message' => $user->registerVerification()]);
            }
        }
        else{
            $this->render('inscription', ['message' => '']);
        }
    }
}