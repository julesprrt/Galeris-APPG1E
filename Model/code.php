<?php

require_once('Model/mailSender.php');
require_once('Constantes/constants.php');
require_once('Database/Database.php');

class Code
{
    private $sendMail;
    public function __construct()
    {//Constructeur -> Initialisation des données
        $this->sendMail = new MailSender();
    }

    public function sendCode($to, $db)
    {
        $code = rand(100000, 999999);
        $this->sendMail->sendMail($to, title_Code_unique, $code, galeris);
        $this->saveCode($db, $code);
    }

    public function saveCode(Database $db, $code)
    {
        $my_date_time = date("Y-m-d H:i:s", strtotime("+1 hours"));
        $conn = $db->connect();
        $sql = "Insert into code (code, date_expiration, ID_user) Values (?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $code, $my_date_time, $_SESSION["usersessionID"]);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }


}
