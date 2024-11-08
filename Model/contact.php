<?php
require 'vendor/autoload.php';
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

    public function contactPlatformGaleris() {
        if($this->verifyAllInput() == false){
            return "Veuillez remplir l'ensemble des champs";
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
