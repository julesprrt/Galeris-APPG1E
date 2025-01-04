<?php

require_once('Controller.php');

class BurgerController extends Controller {

    // Méthode pour afficher le menu burger
    public function burgerMenu() {
        $menuItems = [
            ['label' => 'Accueil', 'link' => '/Galeris-APPG1E/'],
            ['label' => 'Contact', 'link' => '/Galeris-APPG1E/contact'],
            ['label' => 'Ventes', 'link' => '/Galeris-APPG1E/vente'],
            ['label' => 'Encheres', 'link' => '/Galeris-APPG1E/encheres'],
            ['label' => 'News', 'link' => '/Galeris-APPG1E/news'],
        ];

        // Appel à la méthode render() pour afficher la vue avec les données
        $this->render('burgerbar.php', ['menuItems' => $menuItems]);
    }
}
