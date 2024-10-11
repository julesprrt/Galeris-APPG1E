<?php

switch($_SERVER['REQUEST_URI']) {
    case 'controller/accueil':
        echo 'ok';
        break;
    default:
        $method = 'notFound';
        break;
}
