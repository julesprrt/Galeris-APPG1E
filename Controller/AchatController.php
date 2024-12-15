<?php
require_once('Model/achat.php');
require_once('Database/Database.php');
require_once('Controller.php');

class AchatController extends Controller
{
    // Méthode pour afficher les détails d'une œuvre
    public function achat(Database $db, $id)
    {
        // Récupérer l'œuvre depuis le modèle
        $oeuvre = Oeuvre::getOeuvreById($id, $db);

        // Vérifier si l'œuvre existe
        if (!$oeuvre) {
            http_response_code(404);
            echo "L'œuvre demandée est introuvable.";
            return;
        }

        // Transmettre les données à la vue
        $this->render('achat', ['artwork' => $oeuvre]);
    }
}
