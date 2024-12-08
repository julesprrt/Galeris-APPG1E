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
        else if($value === true){
            return "Vous avez déja un compte";
        }
        else{
            //Envoie d'un code a usage unique
            $this->sendCode->sendCode($this->email);
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
        $sql = "SELECT id_utilisateur, actif FROM utilisateur where email = ?" ;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$this->email);
        $stmt->execute();
        $stmt->bind_result($id,$actif);
        if($stmt->fetch()){
            if($actif === 0){
                $stmt->close();
                $conn->close();
                return "actif";
            }
            else{
                session_start();
                $_SESSION["usersessionID"] = $id;
                $stmt->close();
                $conn->close();
                return true;
            }
        }
        return false;
    }

    public function veirfyEmailForPassword(Database $db){
        $result = $this->verifyExistMail($db);
        if(!$this->utilsUser->emailComposition($this->email) && $result === "actif" || !$this->utilsUser->emailComposition($this->email) && $result === false){
            return false;
        }
        else{
            $this->sendCode->sendCode($this->email,$db);
            return true;
        }
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


}