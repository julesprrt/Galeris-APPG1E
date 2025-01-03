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

    public function sendMailCommande($to, $adresse, $codePostale, $ville, $pays){
        $message = '<div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div style="background-color: #0078d4; color: #ffffff; padding: 20px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">Confirmation de Livraison</h1>
        </div>
        <div style="padding: 20px;">
            <p>Bonjour,</p>
            <p>Nous sommes heureux de vous informer que votre commande sera bientôt livrée à l adresse suivante :</p>
            <div style="font-weight: bold; background-color: #f0f8ff; padding: 10px; border-left: 4px solid #0078d4; margin: 10px 0;">
                ' . $adresse .',<br>
                '. $codePostale. ' ' . $ville .', '. $pays .'
            </div>
            <p>Si cette adresse est incorrecte ou si vous souhaitez la modifier, veuillez nous contacter dès que possible.</p>
            <p>Merci de votre confiance,</p>
            <p>L équipe de Galeris</p>
        </div>
        <div style="background-color: #f1f1f1; text-align: center; padding: 10px; font-size: 14px; color: #666;">
            <p>&copy; 2024 Galeris. Tous droits réservés.</p>
        </div>
    </div>';

    $headers = [
        'From' =>  email_galeris,
        'Content-Type' => 'text/html; charset=UTF-8'
    ];

    $subject = "Confirmation de Livraison";

    if(mail($to,$subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
    }
    
}
