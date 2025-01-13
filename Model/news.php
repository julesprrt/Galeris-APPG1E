<?php


require_once('Constantes/constants.php');
require_once('Database/Database.php');
require_once('Model/utils.php');
class News
{
    private $titre;
    private $description;
    private $image1;
    private $image2;
    private $image3;
    private Utils $utils;
    public function __construct($titre,$description,$image1,$image2, $image3)
    {
        $this->titre = $titre;
        $this->description = $description;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
        $this->utils = new Utils();
    }

    public function VerifyAndSavenews(Database $db)
    {
        if ($this->titre === "" || strlen($this->titre) > 50) {
            return 401;
        }
        if(strlen($this->description) < 50){
            return 402;
        }
        if($this->image1 === ""){
            return 403;
        }
        else if($this->image1 !== "" && !$this->utils->verifyImageAndSize($this->image1) || $this->image2 !== "" && !$this->utils->verifyImageAndSize($this->image2) || $this->image3 !== "" && !$this->utils->verifyImageAndSize($this->image3)){
            return 404;
        }
        else if($this->image1 !== "" && $this->utils->human_filesize( $this->image1) >= 1 || $this->image2 !== "" && $this->utils->human_filesize($this->image2) >= 1 || $this->image3 !== "" && $this->utils->human_filesize($this->image3) >= 1){
            return 405;
        }
        $this->saveNews($db);
        if($this->image1 !== ""){
            $this->SaveNewsFile($db, $this->image1);
        }
        if($this->image2 !== ""){
            $this->SaveNewsFile($db, $this->image2);
        }
        if($this->image3 !== ""){
            $this->SaveNewsFile($db, $this->image3);
        }
        return 200;
    }

    public function saveNews(Database $db)
    {
        $Database = $db->connect();
        $sql = "insert into news (titre,description,id_utilisateur) values (?,?,?)";
        $stmt = $Database->prepare($sql);
        $stmt->bind_param('ssi', $this->titre, $this->description, $_SESSION["usersessionID"]);
        $stmt->execute();
        $_SESSION["news_id"] = $Database->insert_id;
        $stmt->close();
        $Database->close();
    }

    public function SaveNewsFile(Database $db, $image){
        $filename = $this->utils->SaveFile($image, "news");
        $Database = $db->connect();
        $sql = "insert into news_images (chemin_image, id_news) values (?,?)";
        $stmt = $Database->prepare($sql);
        $stmt->bind_param("si",$filename,$_SESSION["news_id"]);
        $stmt->execute();
        $stmt->close();
        $Database->close();
    }
    
    public function getNews(Database $db){
        $Database = $db->connect();
        $sql = "SELECT * FROM news n LEFT JOIN ( SELECT id_news, MIN(chemin_image) as 'image_path' FROM news_images GROUP BY id_news ) oi ON oi.id_news = n.id_news where n.date_news > ? ORDER BY n.date_news DESC";
        $stmt = $Database->prepare($sql);
        $now = date('Y-m-d');
        $now = date( 'Y-m-d', strtotime( $now . ' -30 day' ) );
        $stmt->bind_param("s",$now);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $Database->close();
        return $result;
    }

    public function getNewsById($id, Database $db){
        $conn = $db->connect();
        $query = "SELECT n.*, u.*, n.description as 'desc' FROM news n INNER JOIN utilisateur u ON u.id_utilisateur = n.id_utilisateur WHERE id_news = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $news = $result->fetch_assoc();

        $timestamp = strtotime($news["date_news"]);
        $date_news_only = date('d/m/Y', $timestamp);
        $news["date_news"] = $date_news_only;

        $stmt->close();

        // Récupére les images de l'œuvre 
        $queryImages = "SELECT chemin_image FROM news_images WHERE id_news = ?";
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
        $news['chemin_image'] = $chemin_image;


        return $news;
    }


}
