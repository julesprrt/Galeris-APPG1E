<?php
require 'vendor/autoload.php';
require_once('Database/Database.php');
use PHPMailer\PHPMailer\PHPMailer;
Class MailSender {
    public function __construct() {//Constructeur -> Initialisation des données

    }

    public function sendMail($to, $subject, $message, $from) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();   
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->Username = email_galeris;
        $mail->Password = email_galeris_password;
        $mail->setFrom(email_galeris, $from);
    
        $mail->Subject = $subject;
        $mail->Body = $message;
 
        $mail->AddAddress($to);

        if($mail->Send()){
            return true;
        }
        else{
            return false;
        }
    }
    
}
