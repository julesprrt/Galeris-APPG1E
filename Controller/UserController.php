<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');

//Controller utilisateur
class UserController extends Controller
{

    public function inscription(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['name']) && isset($data['firstName']) && isset($data['userName']) && isset($data['email']) && isset($data['telephone']) && isset($data['password']) && isset($data['confirmPassword'])) {//Verification données entré dans le formulaire
            $user = new User($data["name"], $data["firstName"], $data["userName"], $data["email"], $data["telephone"], $data["password"], $data["confirmPassword"]);
            $result = $user->registerVerification($db);//Verifier les données d'inscription
            if ($result === true) {//Si les données sont correct alors envoie du code a usage unique + redirection vers la page  avec le code à usage unique
                $user->saveUser($db);
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            } else if ($result === "code") {
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            } else {//Sinon affiché le message d'erreur sur la vue
                http_response_code(400);
                echo json_encode(['Error' => $result]);
            }
        } else {//Premier affichage sans les données Post
            $this->render('inscription', ['message' => '']);
        }
    }

    //Connexion de l'utilisateur
    public function connexion(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['email']) && isset($data['password'])) {
            $user = new User(null, null, null, $data['email'], null, $data['password'], null);
            // Obtenir une connexion à la base de données
            $result = $user->connectUser($db);
            if ($result === true) {
                http_response_code(200);
                echo json_encode(['Success' => "Connexion réussie"]);
            } else if ($result === "Utilisateur non valide") {
                http_response_code(401);
                echo json_encode(['Information' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            } else {
                http_response_code(400);
                echo json_encode(['Error' => $result]);
            }
        } else {
            $this->render('connexion', ['message' => '']);
        }
    }

    public function password(Database $db)
    {
        $this->render('motdepasseoublie', ['message' => '']);
    }

    public function PässwordMail(Database $db){
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data["email"]) && trim($data["email"]) !== ""){
            $user = new User("","", "", $data["email"], "","","");
            if($user->veirfyEmailForPassword($db)){
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            }
            else{
                http_response_code(400);
                echo json_encode(['Error' => "Mail invalide"]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Entrez votre mail"]);
        }
    }

    public function code() {
        $this->render('codeunique', ['message' => '']);
    }    


    public function confirmationmdp(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['password']) && isset($data['confirmPassword'])) {
            $obj = new user(null, null, null, null, null, $data['password'], $data['confirmPassword']);
            $statusCode = $obj->verifpassword($db);
            if ($statusCode == 200) {
                http_response_code(200);
                echo json_encode(['Success' => "Mot de passe modifié"]);
            } else if ($statusCode === 400) {
                http_response_code(400);
                echo json_encode(['Error' => "Les deux mots de passe ne sont pas identiques"]);
            } else {
                http_response_code(401);
                echo json_encode(['Error' => "Votre mot de passe doit contenir une minuscule, une majucule, un nombre et un caractère spécial et plus que 8 caractères."]);
            }
        } else {
            $this->render('confirmationMDP', ['message' => '']);
        }
    }


    //code verification
    public function sendVerificationCode(Database $db)
    {
        $email = $_POST['email'];

        if ($email) {
            $user = new User(null, null, null, $email, null, null, null);
            $verificationResult = $user->VerifyExistMail($db);

            if ($verificationResult === true || $verificationResult === "actif") {
                $codeModel = new Code();
                $generatedCode = $codeModel->sendCode($email); // model code

                session_start();
                $_SESSION['verification_code'] = $generatedCode; // gard code 
                $_SESSION['email'] = $email; // gard email

                // reload to co deunique
                header("Location: /Galeris-APPG1E/codeunique");
                exit();
            } else {
                session_start();
                if (!isset($_SESSION['failed_attempts'])) {
                    $_SESSION['failed_attempts'] = 0;
                }
                $_SESSION['failed_attempts']++;

                if ($_SESSION['failed_attempts'] >= 5) {
                    header("Location: /Galeris-APPG1E/accueil");
                    exit();
                }

                echo "Compte inexistant. Vous avez encore " . (5 - $_SESSION['failed_attempts']) . " tentatives.";
            }
        } else {
            echo "Veuillez entrer une adresse e-mail valide.";
        }
    }

    public function verifyCode(Database $db)
    {
        session_start();

        if (isset($_SESSION['verification_code'])) {

            $inputCode = implode("", $_POST);

            if ($inputCode == $_SESSION['verification_code']) {
                // reload to reset-password
                header("Location: /Galeris-APPG1E/reset-password");
                exit();
            } else {
                //code no correct
                echo "Erreur de code de vérification. Veuillez réessayer.";
            }
        } else {

            echo "Le code de vérification est introuvable.";
        }
    }

}

