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
                $user->saveUser($db);
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            }
            else if($result === "code"){
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
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

<<<<<<< HEAD
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
            else if($result === "Utilisateur non valide"){
                http_response_code(401);
                echo json_encode(['Information' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
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

    public function code() {
        $this->render('codeunique', ['message' => '']);
    }
}

=======

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
>>>>>>> 3b7090eebeb43d5a5ad4e79360636fe99b6e3503
