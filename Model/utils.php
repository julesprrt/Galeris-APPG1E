<?php


Class Utils {
    public function __construct() {//Constructeur -> Initialisation des données

    }

    /**
     * *
     * @param mixed $email
     * @return mixed
     * Composition du mail via le filtre proposé par PHP
     */
    public function emailComposition($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function SaveFile($image){
        preg_match('/^data:image\/(\w+);base64,/', $image, $type);
        $base64Image = substr($image, strpos($image, ',') + 1);//image en base 64
        $type = strtolower($type[1]);//recuperer le type (exemple .png)
        $base64Image = base64_decode($base64Image); //decodage image

        $filename = "ImageBD/Oeuvre" . '/' . uniqid('image_', true) . '.' . $type; //nom fichier unique

        file_put_contents($filename, $base64Image);//enregistrer l'image dans le dossiser ImageBD/Ouevre
        return $filename;
    }
    
}
