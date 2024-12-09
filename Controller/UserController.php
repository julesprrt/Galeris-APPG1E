<?php
require_once('Model/user.php');
require_once('Database/Database.php');
require_once('Controller.php');

//Controller utilisateur
class   UserController extends Controller
{

    public function inscription(Database $db)
    {
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if (isset($data['name']) && isset($data['firstName']) && isset($data['userName']) && isset($data['email']) && isset($data['telephone']) && isset($data['password']) && isset($data['confirmPassword'])) { //Verification données entré dans le formulaire
            $user = new User($data["name"], $data["firstName"], $data["userName"], $data["email"], $data["telephone"], $data["password"], $data["confirmPassword"]);
            $result = $user->registerVerification($db); //Verifier les données d'inscription
            if ($result === true) { //Si les données sont correct alors envoie du code a usage unique + redirection vers la page  avec le code à usage unique
                $user->saveUser($db);
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

    public function code()
    {
        $this->render('codeunique', ['message' => '']);
    }

    public function profil(Database $db)
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $userId = $_SESSION['user_id'];

        $user = new User(null, null, null, null, null, null, null);
        $userData = $user->getUserById($userId, $db);

        if (!$userData) {
            echo "Utilisateur introuvable.";
            exit();
        }

        // Transmet les données utilisateur à la vue
        $this->render('profil', ['user' => $userData]);
    }
    public function editionprofil(Database $db)
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $userModel = new User(null, null, null, null, null, null, null);
        $user = $userModel->getUserById($userId, $db);

        if (!$user) {
            echo "Utilisateur introuvable.";
            exit();
        }

        $this->render('editionprofil', ['user' => $user]);
    }

    public function processEdition(Database $db)
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /Galeris-APPG1E/connexion');
            exit();
        }

        $userId = $_SESSION['user_id'];

        // Récupération des données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $description = $_POST['description'];
        $adresse = $_POST['adresse'];
        $oldPassword = $_POST['old_password'];
        $newPassword = $_POST['new_password'];
        $confirmPassword = $_POST['confirm_password'];

        $userModel = new User(null, null, null, null, null, null, null);
        $user = $userModel->getUserById($userId, $db);

        if (!$user) {
            echo "Utilisateur introuvable.";
            exit();
        }
        // Validation de l'ancien mot de passe
        if (!password_verify($oldPassword, $user['mot_de_passe'])) {
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

        if (!empty($newPassword) && $newPassword !== $confirmPassword) {
            $this->render('editionprofil', ['user' => $user, 'error' => "Les nouveaux mots de passe ne correspondent pas."]);
            return;
        }
        if (!$userModel->passwordComposition($newPassword)) {
            $this->render('editionprofil', ['user' => $user, 'error' => "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial."]);
            return;
        }

        // Mise à jour des données
        $updated = $userModel->updateUser($userId, $nom, $prenom, $email, $description, $adresse, $newPassword, $db);

        if ($updated) {
            header('Location: /Galeris-APPG1E/profil');
            exit();
        } else {
            $this->render('editionprofil', ['user' => $user, 'error' => "Une erreur est survenue lors de la mise à jour."]);
        }
    }
}
