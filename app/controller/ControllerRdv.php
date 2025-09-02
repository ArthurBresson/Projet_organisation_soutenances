<!-- ----- debut ControllerRdv -->
<?php
require_once '../model/ModelRdv.php';
require_once '../model/ModelCreneau.php';

class ControllerRdv {


        public static function rdvAll() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if ($_SESSION['roles']['role_etudiant'] == 1) {
                $projets = ModelRdv::rdvGetAll($_SESSION['login_id']);
           
                if ($projets == NULL) { // un des éléments n'est pas renseigné
                // ----- Construction chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/projet/viewRdvAllError.php';
                require ($vue);
                return;
            }else{
            
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/rdv/viewRdvAll.php';
            require ($vue);
            }
        }
        }
        
    public static function projetPlanningStep2() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            $results = ModelRdv::selectByProjet($_GET['projet_id']);

            // construire la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewProjetPlanning.php';
            require ($vue);
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);
        }        
    }



    public static function rdvTaken() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // l'utilisateur doit être un étudiant pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_etudiant'] == 1) {
            
            $results = ModelRdv::insert($_GET['creneau_id'], $_SESSION['login_id']);

            if ($results == -1) { // un des éléments n'est pas renseigné
                // ----- Construction chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/rdv/viewRdvTakenError.php';
                require ($vue);
                return;
            }
            
            // on supprime également le créneau de la table creneau lorsque le rdv est pris
            ModelCreneau::delete($_GET['creneau_id']);

            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/rdv/viewRdvTaken.php';
            require ($vue);

        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);
        }
    }

 
}
?>
<!-- ----- fin ControllerRdv -->
