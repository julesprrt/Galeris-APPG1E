<?php

require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/payment.php');
require_once('Model/user.php');
class PaymentController extends Controller
{

    public function payment(Database $db)
    {
        $payment = new Payment();
        $result = $payment->createObject($db);

        if ($result === 401) {
            http_response_code(401);
            echo json_encode(["payment" => "erreur paiement"]);
            exit();
        }

        $id = $result["id"];
        $url = $payment->createPayment($id);
        http_response_code(200);
        $urlPayment = $url["url"];
        echo json_encode(["payment" => $urlPayment]);
    }

    public function successPayment(Database $db)
    {
        session_start();

        if (!isset($_SESSION["payment"])) {
            http_response_code(404);
            header("Location: /Galeris-APPG1E/");

            exit();
        } else {
            if ($_SESSION["payment"] === false) {
                http_response_code(404);
                header("Location: /Galeris-APPG1E/");
                exit();
            } else {
                $_SESSION["payment"] = false;
                if ($_SESSION["type_payment"] === "panier") {
                    $payment = new Payment();
                    $payment->concludePayment($db);
                } else {
                    $payment = new Payment();
                    $payment->concludePaymentAuction($db);
                }
                $this->render('successPayment', []);
            }
        }


    }

    public function cancelPayment(Database $db)
    {
        session_start();
        $this->render('cancelPayment', []);

        if (!isset($_SESSION["payment"])) {
            http_response_code(404);
            header("Location: /Galeris-APPG1E/");
            exit();
        } else {
            if ($_SESSION["payment"] === false) {
                http_response_code(404);
                header("Location: /Galeris-APPG1E/");
                exit();
            } else {
                $_SESSION["payment"] = false;
                $this->render('cancelPayment', []);
            }
        }


    }


    public function solde(Database $db)
    {
        session_start();

        if(!isset($_SESSION["usersessionID"])){
            header('Location: /Galeris-APPG1E/connexion');
            return;
        }

        $user = new User(null,null,null,null,null,null,null,null,null);
        $userAccount = $user->getUserById($_SESSION["usersessionID"], $db);
        $role = isset($_SESSION["usersessionRole"]) === true && $_SESSION["usersessionRole"] === "Admin" ? true : false;
        $this->render('solde', ["connectUser" =>  isset($_SESSION["usersessionID"]), "userRole" => $role, "solde" => $userAccount["solde"]]);
    }

    public function envoiesolde(Database $db){
        session_start();
        $paramData = file_get_contents("php://input");
        $data = json_decode($paramData, true);
        if(isset($data["idStripe"]) && isset($data["solde"])){
            $user = new User(null,null,null,null,null,null,null,null,null);
            $userAccount = $user->getUserById($_SESSION["usersessionID"], $db);
            $payment = new Payment();
            $response = $payment->createTransfert($data["solde"], $data["idStripe"], $userAccount["solde"]);
            if($response === 401){
                http_response_code(401);
                echo json_encode(['Error' => "Le solde ne doit pas être supérieur à " . $userAccount["solde"] . " €"]);
            }
        }
        else{
            http_response_code(400);
            echo json_encode(['Error' => "Veuillez remplir l'ensemble des champs."]);
        }
    }

}
