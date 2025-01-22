<?php
require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/contact.php');

//Controller utilisateur
class ContactController extends Controller
{

  public function contact(Database $db)
  {
    try {
      $paramData = file_get_contents("php://input");
      $data = json_decode($paramData, true);
      if (isset($data['firstName']) && isset($data['name']) && isset($data['email']) && isset($data['subject']) && isset($data['message']) && isset($data['g-recaptcha-response'])) {
        $contact = new Contact($data['firstName'], $data['name'], $data['email'], $data['message'], $data['subject'], $data['g-recaptcha-response']);
        $resultContact = $contact->contactPlatformGaleris();
        if ($resultContact == true && gettype($resultContact) !== 'string') {
          http_response_code(200);
          echo json_encode(['Success' => 'Votre demande a été envoyée.']);
        } else {
          http_response_code(400);
          echo json_encode(['Error' => $resultContact]);
        }
      } else {
        $this->render('contact', ['message' => '']);
      }
    } catch (error) {
      http_response_code(500);
    }
  }
}
