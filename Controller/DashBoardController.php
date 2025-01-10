<?php
require_once('Controller.php');
require_once('Model/vente.php');
require_once('Model/dashboard.php');
require_once('Database/Database.php');

class DashBoardController extends Controller
{
    public function dashboard()
    {
        $db = new Database();
        $vente = new Dashboard();


        $ventes30Jours = $vente->getVentes30DerniersJours($db);
        $datesVentes = [];
        $nombreVentes = [];
        while ($row = $ventes30Jours->fetch_assoc()) {
            $datesVentes[] = $row['date_vente'];
            $nombreVentes[] = $row['nombre_ventes'];
        }

        $topVendeurs = $vente->getTopVendeurs($db);
        $nomsVendeurs = [];
        $nombreVentesVendeurs = [];
        while ($row = $topVendeurs->fetch_assoc()) {
            $nomsVendeurs[] = $row['nom'] . ' ' . $row['prenom'];
            $nombreVentesVendeurs[] = $row['nombre_ventes'];
        }

        $prix30Ventes = $vente->getPrix30DernieresVentes($db);
        $titresVentes = [];
        $prixVentes = [];
        while ($row = $prix30Ventes->fetch_assoc()) {
            $titresVentes[] = $row['Titre'];
            $prixVentes[] = $row['Prix'];
        }

        $this->render('dashboard', [
            'datesVentes' => $datesVentes,
            'nombreVentes' => $nombreVentes,
            'nomsVendeurs' => $nomsVendeurs,
            'nombreVentesVendeurs' => $nombreVentesVendeurs,
            'titresVentes' => $titresVentes,
            'prixVentes' => $prixVentes
        ]);
    }
}
