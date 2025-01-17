<?php
require_once('Database/Database.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

class MailSender
{
    public function __construct()
    {//Constructeur -> Initialisation des données

    }

    public function sendMail($to, $subject, $message, $from)
    {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();                    
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;            
        $mail->Username = email_galeris;
        $mail->Password = 'kwdo bkhh cfat bkbv';

        $mail->setFrom(email_galeris, $from);  

        $mail->AddAddress($to, '');

        $mail->WordWrap = 50;               
        $mail->Priority = 1;
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->IsHTML(true);

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMailCommande($to, $adresse, $codePostale, $ville, $pays)
    {
        $message = '<div style="max-width: 600px; margin: 20px auto; background-color: #ffffff; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
        <div style="background-color: #0078d4; color: #ffffff; padding: 20px; text-align: center;">
            <h1 style="margin: 0; font-size: 24px;">Confirmation de Livraison</h1>
        </div>
        <div style="padding: 20px;">
            <p>Bonjour,</p>
            <p>Nous sommes heureux de vous informer que votre commande sera bientôt livrée à l adresse suivante :</p>
            <div style="font-weight: bold; background-color: #f0f8ff; padding: 10px; border-left: 4px solid #0078d4; margin: 10px 0;">
                ' . $adresse . ',<br>
                ' . $codePostale . ' ' . $ville . ', ' . $pays . '
            </div>
            <p>Si cette adresse est incorrecte ou si vous souhaitez la modifier, veuillez nous contacter dès que possible.</p>
            <p>Merci de votre confiance,</p>
            <p>L équipe de Galeris</p>
        </div>
        <div style="background-color: #f1f1f1; text-align: center; padding: 10px; font-size: 14px; color: #666;">
            <p>&copy; 2024 Galeris. Tous droits réservés.</p>
        </div>
    </div>';



        $subject = "Confirmation de Livraison";

        $mail = new PHPMailer(true);
        $mail->IsSMTP();                    
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;             
        $mail->Username = 'galeris2004@gmail.com';
        $mail->Password = 'kwdo bkhh cfat bkbv';

        $mail->From = email_galeris;

        $mail->AddAddress($to, '');

        $mail->WordWrap = 50;               
        $mail->Priority = 1;
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->IsHTML(true);

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function signalement($oeuvreId, $raison, $titre, $nom, $prenom)
    {
        $mail = $_SESSION['usersessionMail'];
        $user_id = $_SESSION["usersessionID"];
        $to = "galeris2004@gmail.com";
        $subject = "[Signalement Œuvre #$oeuvreId - $titre]";
        $message = '<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f9f9f9; padding: 20px;">
    <div style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 20px; max-width: 600px; margin: auto; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <h2 style="color: #d9534f; font-size: 24px; margin-top: 0;">Signalement d œuvre</h2>
        <p style="margin: 16px 0;">
            L utilisateur 
            <span style="font-weight: bold; color: #5bc0de;">' . $nom . ' ' . $prenom . '</span> 
            (<a href="mailto:$mail" style="color: #5bc0de; text-decoration: none;">' . $mail . '</a>, id : 
            <span style="font-weight: bold; color: #5bc0de;">' . $user_id . '</span>) a signalé l œuvre 
            <span style="font-weight: bold; color: #d9534f;">#' . $oeuvreId . '</span> - 
            <span style="font-style: italic; color: #d9534f;">' . $titre . '</span> pour la raison suivante :
        </p>
        <blockquote style="margin: 20px 0; padding: 15px; border-left: 5px solid #d9534f; background-color: #f7f7f7; color: #555;">
            <b>' . $raison . '</b>
        </blockquote>
    </div>
</body>';

        $mail = new PHPMailer(true);
        $mail->IsSMTP();                    
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;             
        $mail->Username = 'galeris2004@gmail.com';
        $mail->Password = 'kwdo bkhh cfat bkbv';

        $mail->From = email_galeris;

        $mail->AddAddress($to, '');

        $mail->WordWrap = 50;               
        $mail->Priority = 1;
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->IsHTML(true);

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

}
