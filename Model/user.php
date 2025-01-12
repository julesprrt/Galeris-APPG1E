<?php
require_once('Database/Database.php');
require_once('Model/code.php');
require_once('Model/utils.php');
require_once('Model/mailSender.php');
class User
{
    private $name;
    private $firstName;
    private $email;
    private $telephone;
    private $password;
    private $confirmPassword;
    private $sendCode;
    private $utilsUser;
    private MailSender $sendMail;
    private $cgu;
    private $newsletter;
    private $photodeprofil;
    private Utils $utils;
    private $captcha;

    public function __construct($name, $firstName, $email, $telephone, $password, $confirmPassword, $cgu, $newsletter, $photodeprofil, $captcha)
    { //Constructeur -> Initialisation des données
        $this->name = $name;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->sendCode = new Code();
        $this->utilsUser = new Utils();
        $this->cgu = $cgu;
        $this->newsletter = 0;
        $this->photodeprofil = $photodeprofil;
        $this->captcha = $captcha;
        $this->sendMail = new MailSender();
    }
    /**
     * Summary of registerVerification
     * Verifier les données utilisateur
     * @return bool|string
     */
    public function registerVerification(Database $db)
    {
        $value = $this->VerifyExistMail($db);
        if ($this->name === "" || $this->firstName === "" || $this->email === "" || $this->telephone === "" || $this->password === "" || $this->confirmPassword === "") {
            return "Vous devez remplir l'ensemble des champs du formulaire";
        } else if ($this->cgu === false) {
            return "Vous devez valider les conditions générales d'utilisation de Galeris";
        } else if (!$this->utilsUser->emailComposition($this->email)) {
            return "Mail invalide";
        } else if (!$this->telComposition($this->telephone)) {
            return "Format invalide. Exemple : 0689213474";
        } else if (!$this->passwordComposition($this->password)) {
            return "Votre mot de passe doit contenir une minuscule, une majucule, un nombre et un caractère spécial et plus que 8 caractères.";
        } else if ($this->password !== $this->confirmPassword) {
            return "Les deux mots de passe ne sont pas identiques";
        } else if ($value === false) {
            return "Vous avez déja un compte";
        } else  if ($this->utilsUser->verifyCaptcha($this->captcha) == false) {
            return "Veuillez valider le Captcha";
        } else {
            if ($value === true) {
                $this->saveUser($db);
            }
            //Envoie d'un code a usage unique
            $this->sendCode->sendCode($this->email, $db);
            return $value === "actif" ? "code" : true;
        }
    }

    public function connectUser(Database $db)
    {
        if ($this->utilsUser->verifyCaptcha($this->captcha) == false) {
            return "Veuillez valider le Captcha";
        }
        $database = $db->connect();
        // Interroger les données utilisateur dans la base de données
        $query = "SELECT * FROM utilisateur WHERE email = ?";
        $stmt = $database->prepare($query);
        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $database->close();
        if ($result->num_rows > 0) {
            // Obtenir les données utilisateur
            $user = mysqli_fetch_assoc($result);
            // Vérifier le mot de passe
            if (password_verify($this->password, $user['mot_de_passe']) && $user["actif"] === 1) {
                session_start();
                $_SESSION["usersessionMail"] = $this->email;
                $_SESSION["usersessionID"] = $user["id_utilisateur"];
                $_SESSION["usersessionRole"] = $user["roles"];
                return true;
            } else if ($user["actif"] === 0) {
                return "Utilisateur non valide";
            } else {
                return "Votre mail/mot de passe est incorrect";
            }
        } else {
            return "Vous n'avez pas de compte";
        }
    }

    /**
     * Summary of passwordComposition
     * @param mixed $password
     * @return bool
     * Composition du mot de passe (8 caractère au minimum, 1maj, 1 min, 1 caractère spec)
     */
    public function passwordComposition($password)
    {
        $majuscule = preg_match('@[A-Z]@', $password);
        $minucule = preg_match('@[a-z]@', $password);
        $nombre = preg_match('@[0-9]@', $password);
        $caractereSpeciale = preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password);
        if (!$majuscule || !$minucule || !$nombre || !$caractereSpeciale || strlen($password) < 8) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Summary of telComposition
     * @param mixed $tel
     * @return bool
     * Composition du telephone -> 10 caractère ne contenant que des chiffres
     */
    public function telComposition($tel)
    {
        $telWithoutSpace = trim($tel);
        $containOnlyNumber = preg_match('/^\d+$/', $telWithoutSpace);
        if (strlen($telWithoutSpace) === 10 && $containOnlyNumber) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Summary of VerifyExistMail
     * @param Database $db
     * @return mixed
     * Verifier dans la bd si l'utilisateur existe ou non
     */
    public function VerifyExistMail(Database $db)
    {
        $conn = $db->connect();
        $sql = "SELECT * FROM utilisateur where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $this->email);
        $stmt->execute(); 
        $stmt->close();
        $result = $stmt->get_result();
        $conn->close();
        if ($result->num_rows > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user["actif"] === 0) {
                session_start();
                $_SESSION["usersessionID"] = $user["id_utilisateur"];
                return "actif";
            } else {
                return false;
            }
        }
        return true;
    }

    /**
     * Summary of saveUser
     * @param Database $db
     * @return void
     * Ajouter l'utilisateur dans la base de données
     */
    public function saveUser(Database $db)
    {
        $conn = $db->connect();
        $date = date('Y/m/d');
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "Insert into utilisateur (nom, prenom, email, mot_de_passe, date_creation) Values (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $this->name, $this->firstName, $this->email, $hashPassword, $date);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        session_start();
        $_SESSION["usersessionID"] = $id;
        $_SESSION["usersessionMail"] = $this->email;
        $_SESSION["usersessionRole"] = "Utilisateur";
        $_SESSION["usersessionType"] = "";
    }




    public function verifpassword(Database $db)
    {
        if ($this->password !== $this->confirmPassword) {
            return 400;
        } else if (!$this->passwordComposition($this->password)) {
            return 401;
        } else {
            return $this->savePassword($db);
        }
    }

    public function savePassword(Database $db)
    {
        $conn = $db->connect();
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "UPDATE utilisateur SET mot_de_passe = ? where id_utilisateur = 6";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $hashPassword);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return 200;
    }

    public function getAllUsers(Database $db){
        $conn = $db->connect();
        $sql= "select nom, prenom, id_utilisateur from utilisateur";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }   

    public function verifyCode($code, Database $db)
    {
        try {
            $conn = $db->connect();
            $sql = "SELECT code FROM code WHERE ID_user = ? AND date_expiration > NOW() ORDER BY date_expiration DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $id_user = $_SESSION['usersessionID'];
            $stmt->bind_param('i', $id_user);
            $stmt->execute();
            $stmt->bind_result($codedb);
            while ($stmt->fetch()) {
                if ($codedb == $code) {
                    $stmt->close();
                    $updateSql = "UPDATE utilisateur SET actif = 1 WHERE id_utilisateur = ?";
                    $updateStmt = $conn->prepare($updateSql) or die($this->$conn->error);
                    $updateStmt->bind_param('i', $id_user);
                    $updateStmt->execute();
                    $updateStmt->close();
                    $conn->close();
                    return 200;
                } else {
                    if (isset($_SESSION['nberror'])) {
                        $_SESSION['nberror'] =  $_SESSION['nberror'] + 1;
                        if ($_SESSION['nberror'] === 5) {
                            session_destroy();
                            session_start();
                            $_SESSION["userIP"] =  $_SERVER['REMOTE_ADDR'];;
                            $my_date_time = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                            $_SESSION["datetime"] = $my_date_time;
                        }
                    } else {
                        $_SESSION['nberror'] = 1;
                    }
                    return 400;
                }
            }
            return 400;
        } catch (PDOException $e) {
            // Gérer les erreurs
            return "Erreur : " . $e->getMessage();
        }
    }


    public function getUserById($id, Database $db)
    {
        $conn = $db->connect();

        $sql = "SELECT utilisateur.*, utilisateur_image.chemin_image AS photodeprofil, l.adresse as adresse_livraison, l.codepostale, l.ville, l.pays
        FROM utilisateur 
        left join livraison l on l.id_utilisateur = utilisateur.id_utilisateur
        LEFT JOIN utilisateur_image 
        ON utilisateur.id_utilisateur = utilisateur_image.id_utilisateur 
        WHERE utilisateur.id_utilisateur = ?";


        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $stmt->close();
            $conn->close();
            return $user;
        }

        $stmt->close();
        $conn->close();
        return null;
    }
    public function updateUser($id, $nom, $prenom, $email, $description, $adresse, $newsletter, $newPassword, Database $db)
    {
        $conn = $db->connect();

        // Prépare la requête SQL de base
        $sql = "UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, description = ?, adresse = ?, newsletter = ?";
        $types = "sssssi"; // Types pour bind_param
        $params = [$nom, $prenom, $email, $description, $adresse, $newsletter];

        // Si un nouveau mot de passe est fourni, on l'ajoute à la requête
        if (!empty($newPassword)) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql .= ", mot_de_passe = ?";
            $types .= "s"; // Ajoute le type chaîne
            $params[] = $hashedPassword; // Ajoute la valeur
        }

        // Ajoute la condition WHERE
        $sql .= " WHERE id_utilisateur = ?";
        $types .= "i"; // Ajoute le type entier
        $params[] = $id; // Ajoute l'ID utilisateur

        // Prépare et exécute la requête
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$params); // Lie les paramètres
        $result = $stmt->execute();

        $stmt->close();
        $conn->close();
        return $result;
    }

    public function verifyEmailForPassword(Database $db)
    {
        $conn = $db->connect();
        $sql = "select * from utilisateur where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $this->email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        if ($result->num_rows > 0) {
            $email = $this->email;
            $_SESSION["usersessionID"] = $user["id_utilisateur"];
            $_SESSION["usersessionMail"] = $email;
            $_SESSION["usersessionType"] = "password";
            $this->sendCode->sendCode($this->email, $db);
            return true;
        } else {
            return false;
        }
    }

    public function changePassword(Database $db)
    {
        if (!$this->passwordComposition($this->password)) {
            return "Votre mot de passe doit contenir une minuscule, une majucule, un nombre et un caractère spécial et plus que 8 caractères.";
        } else if ($this->password !== $this->confirmPassword) {
            return "Les deux mots de passe ne sont pas identiques";
        } else {
            $conn = $db->connect();
            $sql = "UPDATE utilisateur SET mot_de_passe = ? where id_utilisateur = ?";
            $stmt = $conn->prepare($sql);
            $id_user = $_SESSION['usersessionID'];
            $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
            $stmt->bind_param('si', $hashedPassword, $id_user);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            return true;
        }
    }

    public function updatePhoto($id, $photo, Database $db)
    {
        $conn = $db->connect();
        $sql = "INSERT INTO utilisateur_image (chemin_image, id_utilisateur) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $photo, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function SuppresionAnciennePDP($userId, Database $db)
    {
        $conn = $db->connect();

        $sql = "SELECT chemin_image FROM utilisateur_image WHERE id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $stmt->bind_result($currentPhotoPath);
        $stmt->fetch();
        $stmt->close();

        if ($currentPhotoPath && file_exists($currentPhotoPath)) {
            unlink($currentPhotoPath);
        }

        $sqlDelete = "DELETE FROM utilisateur_image WHERE id_utilisateur = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param('i', $userId);
        $stmtDelete->execute();
        $stmtDelete->close();

        $conn->close();
    }

    public function signaler($raison, Database $db)
    {
        if (strlen(trim($raison)) < 25) {
            return 401;
        }

        $oeuvre = new Oeuvre(null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $oeuvreInfo = $oeuvre->getOeuvreById($_SESSION["oeuvre_id"], $db);
        $userInfo = $this->getUserById($_SESSION["usersessionID"], $db);
        $this->sendMail->signalement($_SESSION["oeuvre_id"], $raison, $oeuvreInfo["Titre"], $userInfo["nom"], $userInfo["prenom"]);
    }

    public function createTransfert($montant, $userSolde, Database $db)
    {
        if (floatval($montant) > $userSolde || floatval($montant) < 1.0) {
            return 401;
        } else {
            $this->transfert(floatval($montant), $_SESSION["usersessionID"], $db);
            return 200;
        }
    }

    public function transfert($montant, $id, Database $db){
        $conn = $db->connect();
        $sql = "update utilisateur set solde = solde - ? where id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('di',$montant, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
    public function getPublicUserById($id, Database $db)
    {
        $conn = $db->connect();
        $sql = "SELECT id_utilisateur, nom, prenom, email, description, photodeprofil 
            FROM utilisateur 
            LEFT JOIN utilisateur_image ON utilisateur.id_utilisateur = utilisateur_image.id_utilisateur
            WHERE utilisateur.id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $user;
    }

    public function getOeuvresByUserId($id, Database $db)
    {
        $conn = $db->connect();
        $sql = "SELECT o.id_oeuvre, o.Titre, o.Description, o.Prix, o.auteur, oi.chemin_image
            FROM oeuvre as o JOIN oeuvre_images as oi ON o.id_oeuvre = oi.id_oeuvre
            WHERE O.id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $oeuvres = [];
        while ($row = $result->fetch_assoc()) {
            $oeuvres[] = $row;
        }
        $stmt->close();
        $conn->close();
        return $oeuvres;
    }
}
