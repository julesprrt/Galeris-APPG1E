<?php
require 'vendor/autoload.php';
require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

Class CodeSender {
    private $sendMail;
    public function __construct() {//Constructeur -> Initialisation des données
        $this->sendMail = new MailSender();
    }

    public function sendCode($to) {
        $code = rand(100000,999999);
        $this->sendMail->sendMail($to,title, "Voici le code à usage unique à entrer : " . $code);
    }
    
}
