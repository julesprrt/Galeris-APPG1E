<?php

require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');
require_once('Model/utils.php');

Class Contact {
    private $sendMail;
    private $name;
    private $firstName;
    private $email;
    private $message;
    private $subject;
    private $utilsContact;

    public function __construct($firstName, $name, $email,$message,$subject) {//Constructeur -> Initialisation des données
        $this->sendMail = new MailSender();
        $this->name = $name;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->message = $message;
        $this->subject = $subject;
        $this->utilsContact = new Utils();
    }

    public function verifyAllInput(){
        if($this->email == '' || $this->name == '' || $this->firstName == '' || $this->message == '' || $this->subject == ''){
            return false;
        }
        else{
            return true;
        }
    }

    public function LimitLengthMessage(){
        if(strlen($this->message) < 15){
            return false;
        }
        else{
            return true;
        }
    }

    public function LimitLengthFirstName(){
        if(strlen($this->name) <= 1){
            return false;
        }
        else{
            return true;
        }
    }

    public function LimitLengthName(){
        if(strlen($this->firstName) <= 1){
            return false;
        }
        else{
            return true;
        }
    }

    public function contactPlatformGaleris() {
        if($this->verifyAllInput() == false){
            return "Veuillez remplir l'ensemble des champs du formulaire";
        }
        if($this->LimitLengthFirstName() == false){
            return "Nombre de caractère minimale pour le champ Prénom est de 2 caractères";
        }
        if($this->LimitLengthName() == false){
            return "Nombre de caractère minimale pour le champs nom est de 2 caractères";
        }
        if($this->LimitLengthMessage() == false){
            return "Nombre de caractère minimale pour le champs message est de 15 caractères";
        }
        if( $this->utilsContact->emailComposition($this->email) == false){
            return "Email invalide";
        }
        $subject_options = [
            'problem' => '[Probleme]',
            'information' => '[Information]',
            'bug' => '[Bug]',
            'others' => '[Autres]',
        ];

        $subject_label = isset($subject_options[$this->subject]) ? $subject_options[$this->subject] : '[Autres]';

        return $this->sendMail->sendMail(email_galeris, $subject_label, $this->message, $this->email);
    }
    
}
