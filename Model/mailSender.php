<?php
require 'vendor/autoload.php';
require_once('Database/Database.php');
use PHPMailer\PHPMailer\PHPMailer;
Class MailSender {
    public function __construct() {//Constructeur -> Initialisation des données

    }

    public function sendMail($to, $subject, $message) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();   
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "galeris2004@gmail.com";
        $mail->Password = "kwdo bkhh cfat bkbv";
    
        $mail->setFrom("galeris2004@gmail.com", "Galeris");
    
        $mail->Subject = $subject;
        $mail->Body = $message;
 
        $mail->AddAddress($to);

        if($mail->Send()){
            echo "ok";
        }
        else{
            echo "nok ";
            echo $mail->ErrorInfo;
        }
    }
    
}
