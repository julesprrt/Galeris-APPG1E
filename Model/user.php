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
    public function __construct($name, $firstName, $userName, $email, $telephone, $password, $confirmPassword) {//Constructeur -> Initialisation des données
        $this->name = $name;
        $this->firstName = $firstName;
        $this->userName = $userName;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }
    /**
     * Summary of registerVerification
     * Verifier les données utilisateur
     * @return bool|string
     */
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
            $_SESSION["usersession"] = array($this->name,$this->firstName,$this->userName,$this->email,$this->telephone,$this->password);//Mettre monatenement dans la session pour les enregistrer dans la bd après que l'utilisateur rentre le code à usage unique
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
}
