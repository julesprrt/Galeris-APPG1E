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

        // 1) VENTES - Nombre de ventes sur 30 derniers jours, groupées par date
        $ventes30Jours = $vente->getVentes30DerniersJours($db);
        $datesVentes = [];
        $nombreVentes = [];
        while ($row = $ventes30Jours->fetch_assoc()) {
            $datesVentes[] = $row['date_vente'];
            $nombreVentes[] = $row['nombre_ventes'];
        }

        // 2) TOP VENDEURS - Sur 30 derniers jours
        $topVendeurs = $vente->getTopVendeurs($db);
        $nomsVendeurs = [];
        $nombreVentesVendeurs = [];
        while ($row = $topVendeurs->fetch_assoc()) {
            $nomsVendeurs[] = $row['nom'] . ' ' . $row['prenom'];
            $nombreVentesVendeurs[] = $row['nombre_ventes'];
        }

        // 3) PRIX 30 DERNIERES VENTES
        $prix30Ventes = $vente->getPrix30DernieresVentes($db);
        $titresVentes = [];
        $prixVentes = [];
        while ($row = $prix30Ventes->fetch_assoc()) {
            $titresVentes[] = $row['Titre'];
            $prixVentes[] = $row['Prix'];
        }

        // 4) Status des ventes
        $venteStatusResult = $vente->getVenteStatus($db);
        $venteStatusLabels = [];
        $venteStatusValues = [];
        while ($row = $venteStatusResult->fetch_assoc()) {
            // Si est_vendu=1 => "Vendu", sinon => "Non Vendu"
            $label = ($row['est_vendu'] == 1) ? "Vendu" : "Non Vendu";
            $venteStatusLabels[] = $label;
            $venteStatusValues[] = $row['total'];
        }

        // 5) Ville des acheteurs
        $villeResult = $vente->getVille($db);
        $villeLabels = [];
        $villeValues = [];
        while ($row = $villeResult->fetch_assoc()) {
            $villeLabels[] = $row['ville'];
            $villeValues[] = $row['total'];
        }

        // 6) Catégories des ventes
        $categorieResult = $vente->getCategorie($db);
        $categorieLabels = [];
        $categorieValues = [];
        while ($row = $categorieResult->fetch_assoc()) {
            $categorieLabels[] = $row['Nom_categorie'];
            $categorieValues[] = $row['total'];
        }

        // 7) Inscriptions des 30 derniers jours
        $inscriptions = $vente->getInscriptions30DerniersJours($db);
        $inscriptionDates = [];
        $inscriptionCounts = [];
        while ($row = $inscriptions->fetch_assoc()) {
            $inscriptionDates[] = $row['date_inscription'];
            $inscriptionCounts[] = $row['nb_inscriptions'];
        }

        // 8)  Statut des expositions
        $expositionStatuts = $vente->getExpositionStatuts($db);
        $statutLabels = [];
        $statutCounts = [];
        while ($row = $expositionStatuts->fetch_assoc()) {
            $statutLabels[] = $row['statut'];
            $statutCounts[] = $row['total'];
        }

        // getBoxStats (total, moyenne, CA mensuel) ---
        $boxStats = $vente->getBoxStats($db);

        // On passe tout ça à la vue
        $this->render('dashboard', [
            'datesVentes'              => $datesVentes,
            'nombreVentes'             => $nombreVentes,
            'nomsVendeurs'             => $nomsVendeurs,
            'nombreVentesVendeurs'     => $nombreVentesVendeurs,
            'titresVentes'             => $titresVentes,
            'prixVentes'               => $prixVentes,
            'inscriptionDates'         => $inscriptionDates,
            'inscriptionCounts'        => $inscriptionCounts,
            'statutLabels'             => $statutLabels,
            'statutCounts'             => $statutCounts,
            'venteStatusLabels'        => $venteStatusLabels,
            'venteStatusValues'        => $venteStatusValues,
            'villeLabels'              => $villeLabels,
            'villeValues'              => $villeValues,
            'categorieLabels'          => $categorieLabels,
            'categorieValues'          => $categorieValues,
            'boxStats'                 => $boxStats
        ]);
    }
}
