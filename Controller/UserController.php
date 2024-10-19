<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');

//Controller utilisateur
Class UserController extends Controller{
    
    public function inscription() {
        if(isset($_POST['name']) && isset($_POST['firstName']) && isset($_POST['userName']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){//Verification données entré dans le formulaire
            $user = new User($_POST["name"], $_POST["firstName"], $_POST["userName"], $_POST["email"], $_POST["telephone"], $_POST["password"],$_POST["confirmPassword"]);
            $result = $user->registerVerification();//Verifier les données d'inscription
            if($result === true){//Si les données sont correct alors envoie du code a usage unique + redirection vers la page  avec le code à usage unique
                echo "Parfait";
                //Envoie code à usage unique
                //Redirection vers la page avec le code à usage unique
                //$this->render('code', ['message' => $user->"Un code vous à été envoyé sur votre adresse mail"]);
            }
            else{//Sinon affiché le message d'erreur sur la vue
                $this->render('inscription', ['message' => $user->registerVerification()]);
            }
        }
        else{//Premier affichage sans les données Post
            $this->render('inscription', ['message' => '']);
        }
    }


    //user connection
    public function connexion() {
        // check if there is a POST request data for log in 
        if (isset($_POST['email']) && isset($_POST['password'])) {
            
            // Obtenir une connexion à la base de données
            $db = Database::connect();

            // Récupérer l'email et le mot de passe saisis par l'utilisateur
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Interroger les données utilisateur dans la base de données
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
                // Obtenir les données utilisateur
                $user = mysqli_fetch_assoc($result);

                // Vérifier le mot de passe
                if (password_verify($password, $user['password'])) {
                    // successful
                    echo "Login successful!";
                } else {
                    // wrong password
                    echo "Invalid password!";
                }
            } else {
                // no user
                echo "No user found with this email!";
            }

            // close connection with database
            mysqli_close($db);
        }
    }
}