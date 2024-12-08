<?php
require_once('Database/Database.php');
require_once('Model/code.php');
require_once('Model/utils.php');

Class User {
    private $name;
    private $firstName;
    private $userName;
    private $email;
    private $telephone;
    private $password;
    private $confirmPassword;
    private $sendCode;
    private $utilsUser;
    public function __construct($name, $firstName, $userName, $email, $telephone, $password, $confirmPassword) {//Constructeur -> Initialisation des données
        $this->name = $name;
        $this->firstName = $firstName;
        $this->userName = $userName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->sendCode = new Code();
        $this->utilsUser = new Utils();
    }
    /**
     * Summary of registerVerification
     * Verifier les données utilisateur
     * @return bool|string
     */
    public function registerVerification(Database $db){
        $value = $this->VerifyExistMail($db);
        if($this->name === "" || $this->firstName === "" || $this->userName === "" || $this->email === "" || $this->telephone === "" || $this->password === "" || $this->confirmPassword === ""){
            return "Vous devez remplir l'ensemble des champs du formulaire";
        }
        else if(!$this->utilsUser->emailComposition($this->email)){
            return "Mail invalide";
        }
        else if(!$this->telComposition($this->telephone)){
            return "Format invalide. Exemple : 0689213474";
        }
        else if(!$this->passwordComposition($this->password)){
            return "Votre mot de passe doit contenir une minuscule, une majucule, un nombre et un caractère spécial et plus que 8 caractères.";
        }
        else if($this->password !== $this->confirmPassword){
            return "Les deux mots de passe ne sont pas identiques";
        }
        else if($value === false){
            return "Vous avez déja un compte";
        }
        else{
            if($value === true){
                $this->saveUser($db);
            }
            //Envoie d'un code a usage unique
            $this->sendCode->sendCode($this->email,$db);
            return $value === "actif" ? "code" : true;
        }
    }

    public function connectUser(Database $db)
    {
        $database = $db->connect();
        // Interroger les données utilisateur dans la base de données
        $query = "SELECT * FROM utilisateur WHERE email = '$this->email'";
        $result = $database->execute_query($query);
        $database->close();
        if (mysqli_num_rows($result) > 0) {
            // Obtenir les données utilisateur
            $user = mysqli_fetch_assoc($result);
            // Vérifier le mot de passe
            if (password_verify($this->password, $user['mot_de_passe']) && $user["actif"] === 1) {
                session_start();
                $_SESSION["usersession"] = $this->email;
                return true;
            } 
            else if($user["actif"] === 0){
                $this->sendCode->sendCode($this->email);
                return "Utilisateur non valide";
            }
            else {
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
    public function passwordComposition($password) {
        $majuscule = preg_match('@[A-Z]@', $password);
        $minucule = preg_match('@[a-z]@', $password);
        $nombre = preg_match('@[0-9]@', $password);
        $caractereSpeciale = preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password);
        if(!$majuscule || !$minucule || !$nombre || !$caractereSpeciale || strlen($password) < 8) {
            return false;
        }
        else{
            return true;
        }
    }

    /**
     * Summary of telComposition
     * @param mixed $tel
     * @return bool
     * Composition du telephone -> 10 caractère ne contenant que des chiffres
     */
    public function telComposition($tel){
        $telWithoutSpace = trim($tel);
        $containOnlyNumber = preg_match('/^\d+$/', $telWithoutSpace);
        if(strlen($telWithoutSpace) === 10 && $containOnlyNumber){
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * Summary of VerifyExistMail
     * @param Database $db
     * @return mixed
     * Verifier dans la bd si l'utilisateur existe ou non
     */
    public function VerifyExistMail(Database $db){
        $conn = $db->connect();
        $sql = "SELECT * FROM utilisateur where email = '$this->email'" ;
        $result = $conn->execute_query($sql);
        $conn->close();
        if(mysqli_num_rows($result) > 0){
            /*while ($row = $user->fetch_assoc()) {
                if($row["actif"] === 0){
                    return false;
                }
            }*/
            $user = mysqli_fetch_assoc($result);
            if($user["actif"] === 0){
                session_start();
                $_SESSION["usersessionID"] = $user["id_utilisateur"];
                return "actif";
            }
            else{
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
    public function saveUser(Database $db){
        $conn = $db->connect();
        $date = date('Y/m/d');
        $hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "Insert into utilisateur (nom, prenom, email, mot_de_passe, date_creation) Values (?,?,?,?,?)" ;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss',$this->name, $this->firstName, $this->email,$hashPassword,$date);
        $stmt->execute();
        $id = $stmt->insert_id;
        $stmt->close();
        session_start();
        $_SESSION["usersessionID"] = $id;
        $_SESSION["usersessionMail"] = $this->email;
    }

    public function verifyCode($code, Database $db) { 
        try {
            session_start();
            $conn = $db->connect();
            $sql = "SELECT code FROM code WHERE ID_user = ? AND date_expiration > NOW() ORDER BY date_expiration DESC LIMIT 1";
            $stmt = $conn->prepare($sql);
            $id_user = $_SESSION['usersessionID'];
            $stmt->bind_param('i', $id_user);
            $stmt->execute();
            $stmt->bind_result($codedb);
            while ($stmt->fetch()) {
                if ($codedb == $code){
                    $stmt->close();
                    $updateSql = "UPDATE utilisateur SET actif = 1 WHERE id_utilisateur = ?";
                    $updateStmt = $conn->prepare($updateSql) or die ($this->$conn->error);
                    $updateStmt->bind_param('i', $id_user);
                    $updateStmt->execute();
                    $updateStmt->close();
                    $conn->close();
                    return 200;
                } else {
                    if(isset($_SESSION['nberror'])){
                        $_SESSION['nberror'] =  $_SESSION['nberror'] + 1;
                        if($_SESSION['nberror'] === 5){
                            session_destroy();
                            session_start();
                            $_SESSION["userIP"] =  $_SERVER['REMOTE_ADDR'];;
                            $my_date_time = date("Y-m-d H:i:s", strtotime("+10 minutes"));
                            $_SESSION["datetime"] = $my_date_time;
                            return 401;
                        } 
                    }
                    else{
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
    
}