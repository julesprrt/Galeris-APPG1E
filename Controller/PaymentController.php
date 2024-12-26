<?php

require_once('Database/Database.php');
require_once('Controller.php');
require_once('Model/payment.php');
class PaymentController extends Controller
{ 

    public function payment(Database $db)
    { 
        $payment = new Payment();
        $result = $payment->createObject($db);

        if($result === 401){
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

    public function successPayment(Database $db){
        session_start();

        if(!isset($_SESSION["payment"])){
            http_response_code(404);
            header("Location: /Galeris-APPG1E/");

            exit();
        }
        else{
            if($_SESSION["payment"] === false){
                http_response_code(404);
                header("Location: /Galeris-APPG1E/");
                exit();
            }
            else{
                $_SESSION["payment"] = false;
                if($_SESSION["type_payment"] === "panier"){
                    $payment = new Payment();
                    $payment->concludePayment($db);
                }
                else{
                    //enchères
                }
                $this->render('successPayment', []);
            }
        }

        
    }

    public function cancelPayment(Database $db){
        session_start();
        $this->render('cancelPayment', []);

      if(!isset($_SESSION["payment"])){
            http_response_code(404);
            header("Location: /Galeris-APPG1E/");
            exit();
        }
        else{
            if($_SESSION["payment"] === false){
                http_response_code(404);
                header("Location: /Galeris-APPG1E/");
                exit();
            }
            else{
                $_SESSION["payment"] = false;
                $this->render('cancelPayment', []);
            }
        }

        
    }
}
