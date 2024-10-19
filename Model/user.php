<?php
require_once('Database/Database.php');

Class User {
    private $name;
    private $firstName;
    private $userName;
    private $email;
    private $telephone;
    private $password;
    private $confirmPassword;
    public function __construct($name, $firstName, $userName, $email, $telephone, $password, $confirmPassword) {
        $this->name = $name;
        $this->firstName = $firstName;
        $this->userName = $userName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function registerVerification(){
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
        else{
            //Envoie d'un code a usage unique
            $_SESSION["usersession"] = array($this->name,$this->firstName,$this->userName,$this->email,$this->telephone,$this->password);
            return true;
        }
    }

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

    public function emailComposition($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
