<?php

require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');
require_once('Model/utils.php');

class Contact
{
    private $sendMail;
    private $name;
    private $firstName;
    private $email;
    private $message;
    private $subject;
    private $utilsContact;
    private $recaptcha;

    public function __construct($firstName, $name, $email, $message, $subject, $recaptcha)
    { //Constructeur -> Initialisation des données
        $this->sendMail = new MailSender();
        $this->name = $name;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->message = $message;
        $this->subject = $subject;
        $this->utilsContact = new Utils();
        $this->recaptcha = $recaptcha;
    }

    public function verifyAllInput()
    {

        if ($this->email == '' || $this->name == '' || $this->firstName == '' || $this->message == '' || $this->subject == '') {
            return false;
        } else {
            return true;
        }
    }

    public function LimitLengthMessage()
    {
        if (strlen($this->message) < 15) {
            return false;
        } else {
            return true;
        }
    }

    public function NameContainOnlyCaracter()
    {
        if (!preg_match('/^[a-zA-Z]+$/', $this->name)) {
            return false;
        } else {
            return true;
        }
    }

    public function FirstNameContainOnlyCaracter()
    {
        if (!preg_match('/^[a-zA-Z]+$/', $this->firstName)) {
            return false;
        } else {
            return true;
        }
    }

    public function contactPlatformGaleris()
    {
        if ($this->utilsContact->verifyCaptcha($this->recaptcha) == false) {
            return "La validation du captcha est obligatoire.";
        }
        if ($this->verifyAllInput() == false) {
            return "Veuillez remplir l'ensemble des champs du formulaire.";
        }
        if ($this->NameContainOnlyCaracter() == false) {
            return "Le nom ne doit contenir que des lettres.";
        }
        if ($this->FirstNameContainOnlyCaracter() == false) {
            return "Le prénom ne doit contenir que des lettres.";
        }
        if ($this->LimitLengthMessage() == false) {
            return "Le nombre de caractère minimale pour le message est de 15 caractères.";
        }
        if ($this->utilsContact->emailComposition($this->email) == false) {
            return "Votre email est invalide.";
        }
        $subject_options = [
            'problem' => '[Probleme]',
            'information' => '[Information]',
            'bug' => '[Bug]',
            'others' => '[Autres]',
        ];

        $subject_label = isset($subject_options[$this->subject]) ? $subject_options[$this->subject] : '[Autres]';

        return $this->sendMail->sendMail(email_galeris, $subject_label, $this->message, $this->email);
    }
}
