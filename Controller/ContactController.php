<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('mailSender.php');

//Controller utilisateur
Class ContactController extends Controller{

    public function contact(Database $db) {

    try {

        if(isset($_POST['firstName']) && isset($_POST['Name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']) )
        {
            $this->render('contact', ['message' => '']);
        }

        
      } catch (error) {
        
        console.error("Une erreur s'est produite :", error);
      }
  
    }



    public function send(Database $db){

      try {

          $firstName = $_POST['firstName'];
          $name = $_POST['Name'];
          $email = $_POST['email'];
          $subject = $_POST['subject'];
          $message = $_POST['message'];

          // Préparer l'e-mail
          $to = $this->mailSender; // Adresse e-mail du destinataire (préconfigurée)
          $headers = "From: $email\r\n";
          $headers .= "Reply-To: $email\r\n";
          $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";


          if (mailSender($to, $subject, $message, $headers)) {
            echo "E-mail envoyé avec succès !";
          } 
          else {
          echo "Échec de l'envoi de l'e-mail.";
          }

          } 
          catch (error) {
        
        console.error("Une erreur s'est produite :", error);
      }

    }


}