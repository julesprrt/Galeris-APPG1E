<?php
require 'vendor/autoload.php';
require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

Class Code{
    private $sendMail;
    public function __construct() {//Constructeur -> Initialisation des données
        $this->sendMail = new MailSender();
    }

    public function sendCode($to) {
        $code = rand(100000,999999);
        $this->sendMail->sendMail($to,title_Code_unique, message_Code_unique . $code, galeris);
    }
}
