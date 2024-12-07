<?php
    class Database {
        /**
         * Lien avec la base de données (MySQL) (Utilisation des données dans le fichier .env Config perso)
         * @return bool|mysqli
         */
        public function connect(){
            $env = parse_ini_file('.env');//init fichier .env
            $host =  $env['HOST'];
            $user = $env['USER'];
            $pass = $env['PASSWORD'];
            $db = $env['DB'];
            $port = $env['PORT'];   
            $connection = mysqli_connect($host, $user, $pass, $db,$port); // je crois que le prof a dit que mysqli c'est viellot et faut mieux utiliser PDO
            return $connection;
        }
    }


