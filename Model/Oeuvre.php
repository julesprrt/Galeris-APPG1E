<?php
require_once('Database/Database.php');
require_once('Model/user.php');
require_once('Model/payment.php');
class Oeuvre
{
    private $Titre;
    private $Description;
    private $eco_responsable;
    private $Date_debut;
    private $Date_fin;
    private $Prix;
    private $type_vente;
    private $est_vendu;
    private $auteur;
    private $id_utilisateur;
    private $id_categorie;
    private $status;
    private $nomvendeur;
    private $prenomvendeur;
    private $chemin_image = [];
    private $prix_actuel;
    private $id_offreur;

    // Constructeur pour initialiser les valeurs
    public function __construct(
        $Titre,
        $Description,
        $eco_responsable,
        $Date_debut,
        $Date_fin,
        $Prix,
        $type_vente,
        $est_vendu,
        $auteur,
        $id_utilisateur,
        $id_categorie,
        $status,
        $nomvendeur,
        $prenomvendeur,
        $chemin_image,
        $prix_actuel,
        $id_offreur

    ) {
        $this->Titre = $Titre;
        $this->Description = $Description;
        $this->eco_responsable = $eco_responsable;
        $this->Date_debut = $Date_debut;
        $this->Date_fin = $Date_fin;
        $this->Prix = $Prix;
        $this->type_vente = $type_vente;
        $this->est_vendu = $est_vendu;
        $this->auteur = $auteur;
        $this->id_utilisateur = $id_utilisateur;
        $this->id_categorie = $id_categorie;
        $this->status = $status;
        $this->nomvendeur = $nomvendeur;
        $this->prenomvendeur = $prenomvendeur;
        $this->chemin_image = $chemin_image;
        $this->prix_actuel = $prix_actuel;
        $this->id_offreur = $id_offreur;
    }

    // Méthode pour récupérer une œuvre par son ID
    public static function getOeuvreById($id, Database $db)
    {
        $conn = $db->connect();
        $query = "SELECT o.*, u.nom, u.prenom, Max(e.prix) AS prix_courant, e.date_enchere, ut.nom AS nom_offreur, ut.prenom AS prenom_offreur FROM oeuvre o INNER JOIN utilisateur u ON u.id_utilisateur = o.id_utilisateur left JOIN enchere e on e.id_oeuvre_enchere = o.id_oeuvre left join utilisateur ut on ut.id_utilisateur = e.id_offreur LEFT JOIN panier p ON p.id_utilisateur = u.id_utilisateur WHERE o.id_oeuvre = ?;";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $oeuvre = $result->fetch_assoc();

        $stmt->close();

        // Récupére les images de l'œuvre 
        $queryImages = "SELECT chemin_image FROM oeuvre_images WHERE id_oeuvre = ?";
        $stmtImages = $conn->prepare($queryImages);
        $stmtImages->bind_param('i', $id);
        $stmtImages->execute();

        $resultImages = $stmtImages->get_result();
        // Récupére les chemins des images
        $chemin_image = [];
        while ($row = $resultImages->fetch_assoc()) {
            $chemin_image[] = $row['chemin_image'];
        }
        $stmtImages->close();
        $conn->close();

        // Ajouter les chemins des images à l'œuvre
        $oeuvre['chemin_image'] = $chemin_image;


        return $oeuvre;
    }
    public static function getAllOeuvre(Database $db)
    {
        $conn = $db->connect();
        $query = " SELECT o.*,c.Nom_categorie, oi.chemin_image, MAX(e.prix) as prix_courant
        FROM oeuvre o
        INNER JOIN oeuvre_images oi ON o.id_oeuvre = oi.id_oeuvre
        Inner join categorie c on c.id_categorie = o.id_categorie
        left JOIN enchere e on e.id_oeuvre_enchere = o.id_oeuvre 
        WHERE o.est_vendu = ? AND o.statut = ? AND o.Date_fin >= ?
        GROUP BY o.id_oeuvre
        ORDER BY o.Date_fin 
        LIMIT 10
    ";
        $stmt = $conn->prepare($query);
        $est_vendu = 0;
        $accept = "accepte";
        $now = new DateTime();
        $now = $now->format('Y-m-d H:i:s');
        $stmt->bind_param('iss', $est_vendu, $accept, $now);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        return $result;
    }

    public function getOeuvresEnAttente(Database $db){
        $Database = $db->connect();
        $sql = "SELECT o.*, c.*, u.*, COALESCE(oi.image_path, 'Aucune image') AS image_path FROM oeuvre o INNER JOIN categorie c ON c.id_categorie = o.id_categorie INNER join utilisateur u on u.id_utilisateur = o.id_utilisateur LEFT JOIN ( SELECT id_oeuvre, MIN(chemin_image) AS image_path FROM oeuvre_images GROUP BY id_oeuvre ) oi ON oi.id_oeuvre = o.id_oeuvre WHERE o.statut = ?";
        $stmt = $Database->prepare($sql);
        $accept = "en attente de validation";
        $stmt->bind_param("s", $accept);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $Database->close();
        return $result;
    }

    public function updateStatut(Database $db, $accept, $id){
        $Database = $db->connect();
        $sql = "Update oeuvre set statut = ? where id_oeuvre = ?";
        $statut = $accept === true ? "accepte" : "refuse";
        $stmt = $Database->prepare($sql);
        $realID = (int)$id;
        $stmt->bind_param("si",$statut,$realID);
        $stmt->execute();
        $stmt->close();
        $Database->close();
    }

    public function getAllEnchere($id, Database $db){
        $conn = $db->connect();
        $query = "SELECT * FROM enchere e left join utilisateur ut on ut.id_utilisateur = e.id_offreur WHERE e.id_oeuvre_enchere = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        return $result;
    }

    public function verifyEnchere(Database $db){
        $user = new User(null,null,null,null,null,null,null);
        $userLivraison = $user->getUserById($_SESSION["usersessionID"],$db);
        if($userLivraison["adresse_livraison"] === null || $userLivraison["adresse_livraison"] === ""){
            return 401;
        }
        
        $oeuvre = $this->getOeuvreById($_SESSION['oeuvre_id'], $db);

        if($oeuvre["prix_courant"] === null){
            return [
                "prixCourant" => $oeuvre["Prix"] * 1.10,
                "adresse" => $userLivraison["adresse_livraison"]
            ];
        }

        return [
            "prixCourant" => $oeuvre["prix_courant"] * 1.10,
            "adresse" => $userLivraison["adresse_livraison"]
        ];
    }

    public function enchere(Database $db, $prix){
        $prixCourant = $this->verifyEnchere($db);
        if(round(floatval($prix), 2) < round($prixCourant["prixCourant"],2)){
            return [
                "prixCourant" => $prixCourant["prixCourant"],
                "statut" => 401
            ];
        }
        else{
            $payment = new Payment();
            $paymentId = $payment->createObjectForAuction($db, $prix);
            $id = $paymentId["id"];
            $url = $payment->createPayment($id);
            $_SESSION["auction_price"] = $prix;
            return [
                "url" => $url,
                "statut" => 200
            ];
        }
    }
}
