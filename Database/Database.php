<?php

    function connect(){
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'galeris';   
        $connection = mysqli_connect($host, $user, $pass, $db, 3310);
        return $connection;
    }


