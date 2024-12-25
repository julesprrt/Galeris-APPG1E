<?php


require_once('Constantes/constants.php');
require_once('Database/Database.php');

class Payment
{
    private $headers;

    public function __construct()
    {//Constructeur -> Initialisation des données
        $this->headers = array('Authorization: Bearer '.STRIPE_API_KEY);
    }

    public function createObject(){
        session_start();
        $_SESSION["payment"] = true;
        $curl = curl_init();
        $fields = array();
        $fields["currency"] = 'eur';
        $fields['unit_amount'] = 10000000; 
        $fields['product_data'] = array(
            'name' => "test"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_URL, stripe_create_object_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($curl);
        curl_close($curl);

        return json_decode($output, true); // return php array with api response
    }
    public function createPayment($id)
    {
        $curl = curl_init();
        $fields = array();
        $fields['line_items'] = array(
            array('price' => $id,
            'quantity' => 1,)
        );
        $fields["success_url"] = 'https://galeris/Galeris-APPG1E/success';
        $fields["cancel_url"] = 'https://galeris/Galeris-APPG1E/cancel';
        $fields['mode'] = "payment";
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_URL, stripe_create_payment_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($curl);
        curl_close($curl);

        return json_decode($output, true); // return php array with api response
    }
}