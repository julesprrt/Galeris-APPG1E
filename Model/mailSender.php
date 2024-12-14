<?php
require_once('Database/Database.php');

Class MailSender {
    public function __construct() {//Constructeur -> Initialisation des données

    }

    public function sendMail($to, $subject, $message, $from) {
        $headers = [
            'From' =>  $from . '<' . $to .'>',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];
        if(mail($to,$subject, $message,$headers)){
            return true;
        }
        else{
            return false;
        }
    }
    
}
