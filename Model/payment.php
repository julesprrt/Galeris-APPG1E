<?php


require_once('Constantes/constants.php');
require_once('Database/Database.php');
require_once('Model/panier.php');
require_once('Model/mailSender.php');
require_once('Model/livraison.php');

class Payment
{
    private $headers;
    private Panier $panier;
    private MailSender $sendMail;
    private Livraison $livraison;

    public function __construct()
    {//Constructeur -> Initialisation des données
        $this->headers = array('Authorization: Bearer '.STRIPE_API_KEY);
        $this->panier = new Panier();
        $this->sendMail = new MailSender();
        $this->livraison = new Livraison(null,null,null,null,null,null);
    }

    public function createObject(Database $db){
        session_start();
        $amount = $this->panier->getTotalAmountPanier($db);
        if($amount == 0){
            return 401;
        }
        $amount = floatval($amount);
        $_SESSION["payment"] = true;
        $_SESSION["type_payment"] = "panier";
        $curl = curl_init();
        $fields = array();
        $fields["currency"] = 'eur';
        $fields['unit_amount'] = $amount * 100; 
        $fields['product_data'] = array(
            'name' => "Oeuvre d'art"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_URL, stripe_create_object_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($curl);
        curl_close($curl);

        return json_decode($output, true); 
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
        return json_decode($output, true); 
    }

    public function createObjectForAuction(Database $db, $amount){
        $_SESSION["payment"] = true;
        $_SESSION["type_payment"] = "enchere";
        $curl = curl_init();
        $fields = array();
        $fields["currency"] = 'eur';
        $fields['unit_amount'] = $amount * 100; 
        $fields['product_data'] = array(
            'name' => "Oeuvre d'art"
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($curl, CURLOPT_URL, stripe_create_object_url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($curl);
        curl_close($curl);

        return json_decode($output, true); 
    }


    public function concludePayment(Database $db){
        $this->updateUserSold($db);//Mise a jour solde utilisateur (pour chaque utilisateur concerné)
        //insertion pour chaque vente dans la table vente
        $this->updateOeuvre($db);//Vente = 1
        $this->supprimerPanier($db);//Supprimer l'ensemble du panier de l'utilisateur
        $this->confirmMail($db);
    }

    public function confirmMail(Database $db){
        $result = $this->livraison->getLivraison($db);
        $this->sendMail->sendMailCommande($_SESSION["usersessionMail"], $result["adresse"], $result["codepostale"], $result["ville"], $result["pays"]);
    }

    public function updateOeuvre(Database $db){
        $conn = $db->connect();
        $sql = "update panier p inner join oeuvre o on o.id_oeuvre = p.id_oeuvre set o.est_vendu = ? where p.id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $est_vendu = 1;
        $id_utilisateur = $_SESSION["usersessionID"];
        $stmt->bind_param("ii", $est_vendu, $id_utilisateur);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function updateUserSold(Database $db){
        $conn = $db->connect();
        $sql = "select u.id_utilisateur as utilisateur, o.prix, o.id_oeuvre from utilisateur u inner join oeuvre o on o.id_utilisateur = u.id_utilisateur inner join panier p on p.id_oeuvre = o.id_oeuvre where p.id_utilisateur = ? and o.est_vendu = ? and o.Date_fin > ?";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $est_vendu = 0;
        $actualDate = date('Y-m-d H:i:s');
        $stmt->bind_param("iis", $id_utilisateur, $est_vendu, $actualDate);
        $stmt->execute();

        $userpanier =$stmt->get_result();
        $stmt->close();

        $sql = "update utilisateur u set u.solde = u.solde + ? where u.id_utilisateur = ?";
        $sqlVente = "insert into vente (prix, id_oeuvre, id_utilisateur) values (?,?,?)";
        foreach ($userpanier as $panier) {
           $stmtPanier = $conn->prepare($sql);
           $stmtPanier->bind_param("di", $panier["prix"], $panier["utilisateur"]);
           $stmtPanier->execute();
           $stmtPanier->close();

           $stmtVente = $conn->prepare($sqlVente);
           $stmtVente->bind_param('dii', $panier["prix"], $panier["id_oeuvre"],$id_utilisateur);
           $stmtVente->execute();
           $stmtVente->close();
        }
        $conn->close();
    }

    public function supprimerPanier(Database $db){
        $conn = $db->connect();
        $sql = "Delete from panier where id_utilisateur = ?";
        $stmt = $conn->prepare($sql);
        $id_utilisateur = $_SESSION["usersessionID"];
        $stmt->bind_param("i", $id_utilisateur);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }

    public function concludePaymentAuction(Database $db){
        $price_Auction = $_SESSION["auction_price"];
        $oeuvreID = $_SESSION['oeuvre_id'];
        $userID =$_SESSION['usersessionID'];
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        unset($_SESSION["auction_price"]);
        $conn = $db->connect();
        $sql = "insert into enchere (id_oeuvre_enchere, prix, id_offreur, date_enchere) values (?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("idis", $oeuvreID,$price_Auction,$userID,$now);
        $stmt->execute();
        $stmt->close();
        $conn->close();
    }
}