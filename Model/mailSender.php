<?php
require_once('Database/Database.php');

class MailSender
{
    public function __construct()
    {//Constructeur -> Initialisation des données

    }

    public function sendMail($to, $subject, $code, $from)
    {
        $logogaleris =
            $message = '
        <html>
        <head>
          <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; background-color: #f0da8c; color: #4C4241 ; border-radius: 20px; }
            .header { text-align: center; font-family: mono; padding: 10px 0; }
            .footer { text-align: center; padding: 10px 0; font-size: 12px; }
            .content { padding: 20px; }
            .codeUnique { font-weight: bold; font-size: 20px }
            img { }
          </style>
        </head>
        <body>
          <div class="header">
            <h1> Galeris </h1>
          </div>
          <div class="content">
            <p>Bonjour,</p>
            <p>Bienvenue chez Galeris,</p>
            <p>Nous vous prions de bien vouloir trouver ci-dessous votre code à usage unique,</p>
            <p>celui-ci est indispensable pour finaliser votre inscription :</p>
            <p class="codeUnique"> ' . $code . ' </p>
            <p>Bien cordialement,</p>
            <p>L équipe Galeris</p>
          </div>
          <div class="footer">
            <img alt="Logo Galeris" src="../images/logo.png" />
            <p>© 2024 Galeris. Tous droits réservés.</p>
          </div>
        </body>
      </html>
        ';
        $headers = [
            'From' => $from . '<' . $to . '>',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];
        if (mail($to, $subject, $message, $headers)) {
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

        $headers = [
            'From' => email_galeris,
            'Content-Type' => 'text/html; charset=UTF-8'
        ];

        $subject = "Confirmation de Livraison";

        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMailContact($to, $subject, $message, $from)
    {
        $headers = [
            'From' => $from . '<' . $to . '>',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];
        if (mail($to, $subject, $message, $headers)) {
            $this->SendConfirmationMailForUser($from);
            return true;
        } else {
            return false;
        }
    }

    public function SendConfirmationMailForUser($to)
    {
        $headers = [
            'From' => 'galeris2004@gmail.com',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];
        $message = `
      <html>
        <head>
          <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 0; background-color: #f0da8c; color: #4C4241 ; border-radius: 20px }
            .header { text-align: center; font-family: mono; padding: 10px 0 }
            .footer { text-align: center; padding: 10px 0; font-size: 12px }
            .content { padding: 20px }
          </style>
        </head>
        <body>
          <div class="header">
            <h1> Galeris </h1>
          </div>
          <div class="content">
            <p>Bonjour,</p>
            <p>Nous vous confirmons la bonne réception de votre message.</p>
            <p>Nous vous répondrons dans les plus brefs délais.</p>
            <p>Bien cordialement,</p>
            <p>L'équipe Galeris</p>
          </div>
          <div class="footer">
            <img alt="Logo Galeris" />
            <p>© 2024 Galeris. Tous droits réservés.</p>
          </div>
        </body>
      </html>
    `;
        if (mail($to, 'galeris2004@gmail.com', $message, $headers)) {
            return true;
        } else {
            return false;
        }
    }

}
