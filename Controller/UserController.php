<?php
require_once('Model/user.php');
require_once('Model/code.php');
require_once('Database/Database.php');
require_once('Controller.php');

//Controller utilisateur
class UserController extends Controller
{

    public function inscription(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['name']) && isset($data['firstName']) &&  isset($data['email']) && isset($data['telephone']) && isset($data['password']) && isset($data['confirmPassword']) && isset($data['cgu']) && isset($data['g-recaptcha-response'])) { //Verification données entré dans le formulaire
            $user = new User($data["name"], $data["firstName"],  $data["email"], $data["telephone"], $data["password"], $data["confirmPassword"], $data["cgu"], null, null, $data['g-recaptcha-response']);
            $result = $user->registerVerification($db); //Verifier les données d'inscription
            if ($result === true) { //Si les données sont correct alors envoie du code a usage unique + redirection vers la page  avec le code à usage unique
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            } else if ($result === "code") {
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            } else { //Sinon affiché le message d'erreur sur la vue
                http_response_code(400);
                echo json_encode(['Error' => $result]);
            }
        } else { //Premier affichage sans les données Post
            $this->render('inscription', ['message' => '']);
        }
    }

    //Connexion de l'utilisateur
    public function connexion(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['email']) && isset($data['password']) && isset($data['g-recaptcha-response'])) {
            $user = new User(null, null, $data['email'], null, $data['password'], null, null, null, null, $data['g-recaptcha-response']);
            // Obtenir une connexion à la base de données
            $result = $user->connectUser($db);
            if ($result === true) {
                http_response_code(200);
                echo json_encode(['Success' => "Connexion réussie"]);
            } else if ($result === "Utilisateur non valide") {
                http_response_code(401);
                echo json_encode(['Information' => "Veuillez vous inscrire"]);
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
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }
        
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data["email"]) && trim($data["email"]) !== "") {
            $user = new User("", "", $data["email"], "", "", "", "", null,null,null);
            if ($user->verifyEmailForPassword($db)) {
                http_response_code(200);
                echo json_encode(['Success' => "Un code vous à été envoyé sur votre adresse mail pour confirmer votre identité"]);
            } else {
                http_response_code(400);
                echo json_encode(['Error' => "Mail invalide"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['Error' => "Entrez votre mail"]);
        }
    }

    public function code(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['code'])) {
            $user = new User(null,null,null,null,null,null,null, null, null, null);
            $response = $user->verifyCode($data['code'],$db);
            $type = $_SESSION["usersessionType"];
            if ($response == 200 && $type === "") {
                http_response_code(200);
                echo json_encode(['Success' => "Inscription reussie"]);
            } else if ($response == 200 && $type === "password") {
                http_response_code(200);
                echo json_encode(['Success' => $type]);
            } else {
                http_response_code(400);
                echo json_encode(['Error' => "Code incorrect"]);
            }
        } else {
            $this->render('codeunique', ['message' => '']);
        }
    }

    public function profil(Database $db)
    {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $userId = $_SESSION['usersessionID'];
        $_SESSION["livraison"] = "profil";

        $user = new User(null, null,  null, null, null, null, null, null, null, null);
        $userData = $user->getUserById($userId, $db);

        if (!$userData) {
            echo "Utilisateur introuvable.";
            exit();
        }

        // Transmet les données utilisateur à la vue
        $this->render('profil', ['user' => $userData, "connectUser" => isset($_SESSION["usersessionID"]), "userRole" => $role]);
    }
    public function editionprofil(Database $db)
    {
        session_start();
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $userId = $_SESSION['usersessionID'];
        $userModel = new User(null, null,  null, null, null, null, null, null, null, null); 
        $user = $userModel->getUserById($userId, $db);

        if (!$user) {
            echo "Utilisateur introuvable.";
            exit();
        }

        $this->render('editionprofil', ['user' => $user, "connectUser" => isset($_SESSION["usersessionID"]), "userRole" => $role]);
    }

    public function processEdition(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $userId = $_SESSION['usersessionID'];
        

        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $description = $_POST['description'];
        $adresse = $_POST['adresse'];
        $newsletter = isset($_POST['newsletter']) ? 1 : 0; 
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];
        
        $photoFile = $_FILES['profile_photo'];
        $photoPath = null;  
        if ($photoFile && $photoFile['error'] === UPLOAD_ERR_OK) {
    
            // Génération d'un nom de fichier unique
            $uploadDir = 'ImageBD/Profil/';
            $fileName = uniqid('profile_', true) . '.' . pathinfo($photoFile['name'], PATHINFO_EXTENSION);
    
            // Déplacement du fichier vers le dossier `ImageBD/Profil`
            if (!move_uploaded_file($photoFile['tmp_name'], $uploadDir . $fileName)) {
                $this->render('editionprofil', ['error' => "Erreur lors du téléchargement de la photo."]);
                return;
            }
    
            // Stockage du chemin relatif
            $photoPath = $uploadDir . $fileName;
        }
        $userModel = new User(null, null,  null, null, null, null, null, null, null, null);
        $user = $userModel->getUserById($userId, $db);


        if (!$user) {
            echo "Utilisateur introuvable.";
            exit();
        }
        // Validation de l'ancien mot de passe
        if (strlen($oldPassword) > 0 && !password_verify($oldPassword, $user['mot_de_passe'])) {
            $this->render('editionprofil', ['user' => $user, 'error' => "L'ancien mot de passe est incorrect."]);
            return;
        }
        // Validation des nouvelles données
        if (empty($nom) || empty($prenom) || empty($email)) {
            $this->render('editionprofil', ['user' => $user, 'error' => "Tous les champs obligatoires doivent être remplis."]);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->render('editionprofil', ['user' => $user, 'error' => "L'adresse email est invalide."]);
            return;
        }

        if (strlen($oldPassword) > 0 && !empty($newPassword) && $newPassword !== $confirmPassword) {
            $this->render('editionprofil', ['user' => $user, 'error' => "Les nouveaux mots de passe ne correspondent pas."]);
            return;
        }
        if (strlen($oldPassword) > 0 && !$userModel->passwordComposition($newPassword)) {
            $this->render('editionprofil', ['user' => $user, 'error' => "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial."]);
            return;
        }

        // Mise à jour des données
        $updated = $userModel->updateUser($userId, $nom, $prenom, $email, $description, $adresse, $newsletter, $newPassword, $db);
        $userModel->SuppresionAnciennePDP($userId, $db);
        $userModel->updatePhoto($userId, $photoPath, $db);

        if ($updated) {
            header('Location: /Galeris-APPG1E/profil');
            exit();
        } else {
            $this->render('editionprofil', ['user' => $user, 'error' => "Une erreur est survenue lors de la mise à jour."]);
        }
    }

    public function resendcode(Database $db)
    {
        session_start();
        
        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $code = new Code();

        $code->sendCode($_SESSION["usersessionMail"], $db);

        $code->sendCode($_SESSION["usersessionMail"], $db);
        http_response_code(200);
        echo json_encode(['Success' => "Code envoyé"]);
    }

    public function Deconnexion()
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }
        
        session_destroy();

        http_response_code(200);
        echo json_encode(['Success' => "Déconnexion réussie"]);
    }

    public function confirmationMDP(Database $db)
    {
        session_start();

        if(!isset($_SESSION["usersessionID"])){
            header('Location: /Galeris-APPG1E/connexion');
            exit;
        }

        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['password']) && isset($data['confirmPassword'])) {
            $user = new User(null, null,  null, null, $data['password'], $data['confirmPassword'],null, null, null, null );
            $result = $user->changePassword($db);
            if ($result === true) {
                http_response_code(200);
                echo json_encode(["Success" => "Mot de passe modifié"]);
                session_destroy();
            } else {
                http_response_code(400);
                echo json_encode(["Error" => $result]);
            }

        } else {
            $this->render('confirmationMDP', []);
        }
    }

    public function signalerOeuvre(Database $db)
    {
        session_start();

        if (!isset($_SESSION['usersessionID'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }
        
        // Récupération des données POST (JSON)
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);

        if (isset($data['raison']) && trim($data['raison']) !== '') {
            $user = new User(null, null, null, null, null, null, null,null,null,null);
            $code = $user->signaler($data['raison'], $db);

            if($code === 401){
                http_response_code(401);
                echo json_encode(['Error' => 'La raison de votre signalement doit contenir plus que 25 caractères.']);
            }


            http_response_code(200);
            echo json_encode(['Success' => 'Signalement envoyé avec succès.']);

        } else {
            http_response_code(400);
            echo json_encode(['Error' => "Données invalides pour le signalement (oeuvre_id, raison)."]);
        }
    }
}
