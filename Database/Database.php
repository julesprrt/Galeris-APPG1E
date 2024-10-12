<?php
    class Database {
        /**
         * Lien avec la base de données (MySQL) (Utilisation des données dans le fichier .env Config perso)
         * @return bool|mysqli
         */
        public function connect(){
            $env = parse_ini_file('../.env');//init fichier .env
            $host =  $env['HOST'];
            $user = $env['USER'];
            $pass = $env['PASSWORD'];
            $db = $env['DB'];
            $port = $env['PORT'];   
            $connection = mysqli_connect($host, $user, $pass, $db,$port);
            return $connection;
        }
    }


