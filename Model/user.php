<?php
require_once('Database/Database.php');
require_once('Model/codeSender.php');

Class User {
    private $name;
    private $firstName;
    private $userName;
    private $email;
    private $telephone;
    private $password;
    private $confirmPassword;
    private $sendCode;
    public function __construct($name, $firstName, $userName, $email, $telephone, $password, $confirmPassword) {//Constructeur -> Initialisation des données
        $this->name = $name;
        $this->firstName = $firstName;
        $this->userName = $userName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->sendCode = new CodeSender();
    }
    /**
     * Summary of registerVerification
     * Verifier les données utilisateur
     * @return bool|string
     */
    public function registerVerification(Database $db){
        if($this->name === "" || $this->firstName === "" || $this->userName === "" || $this->email === "" || $this->telephone === "" || $this->password === "" || $this->confirmPassword === ""){
            return "Vous devez remplir l'ensemble des champs du formulaire";
        }
        else if(!$this->emailComposition($this->email)){
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
        else if($this->VerifyExistMail($db) > 0){
            return "Vous avez déja un compte";
        }
        else{
            //Envoie d'un code a usage unique
            session_start();
            $_SESSION["usersession"] = array("name" => $this->name, "firstname" => $this->firstName, "username" => $this->userName,"email" => $this->email,"telephone" => $this->telephone, "password" => $this->password);//Mettre monatenement dans la session pour les enregistrer dans la bd après que l'utilisateur rentre le code à usage unique
            $this->sendCode->sendCode($this->email);
            return true;
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
     * *
     * @param mixed $email
     * @return mixed
     * Composition du mail via le filtre proposé par PHP
     */
    public function emailComposition($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    /**
     * Summary of VerifyExistMail
     * @param Database $db
     * @return mixed
     * Verifier dans la bd si l'utilisateur existe ou non
     */
    public function VerifyExistMail(Database $db){
        $conn = $db->connect();
        $sql = "SELECT count(*) as total FROM utilisateur where email = ?" ;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$this->email);
        $stmt->execute();
        $stmt->bind_result($total);
        $stmt->fetch();
        $stmt->close();
        return $total;
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
        $hashPassword = password_hash($_SESSION["usersession"]["password"], PASSWORD_DEFAULT);
        $sql = "Insert into utilisateur (nom, prenom, email, mot_de_passe, date_creation) Values (?,?,?,?,?)" ;
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss',$_SESSION["usersession"]["name"], $_SESSION["usersession"]["firstname"], $_SESSION["usersession"]["email"],$hashPassword,$date);
        $stmt->execute();
        $stmt->close();
        $emailSession = $_SESSION["usersession"]["email"];
        session_destroy();
        session_start();
        $_SESSION["usersession"] = $emailSession;
    }
}
