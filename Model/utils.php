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

    public function telComposition($tel)
    {
        $telWithoutSpace = trim($tel);
        $containOnlyNumber = preg_match('/^\d+$/', $telWithoutSpace);
        if (strlen($telWithoutSpace) === 10 && $containOnlyNumber) {
            return true;
        } else {
            return false;
        }
    }

    public function verifyImageAndSize($image){
        return getimagesize($image) ? true : false;
    }

    public function human_filesize($base64Image){ //return memory size in B, KB, MB
        try{
            $size_in_bytes = (int) (strlen(rtrim($base64Image, '=')) * 3 / 4);
            $size_in_kb    = $size_in_bytes / 1024;
            $size_in_mb    = $size_in_kb / 1024;
    
            return $size_in_mb;
        }
        catch(Exception $e){
            return $e;
        }
    }
    public function SaveFile($image,$repository){
        preg_match('/^data:image\/(\w+);base64,/', $image, $type);
        $base64Image = substr($image, strpos($image, ',') + 1);//image en base 64
        $type = strtolower($type[1]);//recuperer le type (exemple .png)
        $base64Image = base64_decode($base64Image); //decodage image


        $filename = "ImageBD/{$repository}" . '/' . uniqid('image_', true) . '.' . $type; //nom fichier unique


        file_put_contents($filename, $base64Image);//enregistrer l'image dans le dossiser ImageBD/Ouevre
        return $filename;
    }

    public function getMaxAndMinPriceFromMySQL($oeuvres){
        $result = [];
        foreach ($oeuvres as $oeuvre) {
            if(!array_key_exists("min", $result)){
                $result["min"] = $oeuvre["Prix"];
            }
            if(!array_key_exists("max", $result)){
                $result["max"] = $oeuvre["Prix"];
            }
            if($result["min"] > $oeuvre["Prix"]){
                $result["min"] = $oeuvre["Prix"];
            }
            if($result["max"] < $oeuvre["Prix"]){
                $result["max"] = $oeuvre["Prix"];
            }
        }
        return $result;
    }
    public function verifyCaptcha($response){
        $secretKey = "6Lf0tIkqAAAAAAATTCwNZELpV0tpppZAjBwAXBoc";
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($response);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
            return true;
        } else {
            return false;
        }
    }
}
