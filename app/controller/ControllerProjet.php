<!-- ----- debut ControllerProjet -->
<?php
require_once '../model/ModelProjet.php';

class ControllerProjet {

    // affiche la liste des projets du responsable connecté
    public static function projetResponsableAll() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            $projets = ModelProjet::getProjetByResponsable($_SESSION['login_id']);
            include 'config.php';
            $vue = $root . '/app/view/projet/viewProjetResponsableAll.php';
            echo ("ControllerProjet : projetResponsableAll : vue = $vue");
            require ($vue);   
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewSoutenanceForbidden.php';
            if (DEBUG)
            echo ("ControllerProjet : projetResponsableAll : vue = $vue");
            require ($vue);  
        }
    }


    public static function projetAdd() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewProjetAdd.php';
            if (DEBUG)
            echo ("ControllerProjet : projetAdd : vue = $vue");
            require ($vue);
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            if (DEBUG)
            echo ("ControllerProjet : projetResponsableAll : vue = $vue");
            require ($vue);  
        }
    }

    public static function projetAdded() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            
            $results = ModelProjet::insert($_GET['label'], $_SESSION['login_id'], $_GET['groupe']);

            if ($results == -1) { // un des éléments n'est pas renseigné
                // ----- Construction chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/projet/viewProjetAddError.php';
                require ($vue);
                return;
            }
            
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewProjetAdded.php';
            require ($vue);

        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);  
        }
    }


    // cette fonction affiche un formulaire de sélection d'un projet, pour ensuite afficher les examinateurs de ce projet
    public static function projetExaminateur() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            $projets = ModelProjet::getProjetByResponsableWithId($_SESSION['login_id']);
            $mode = "les examinateurs"; 
            $action = "projetExaminateurStep2"; // ces variables permet d'utiliser plusieurs fois la même vue

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewProjetSelectByResponsable.php';
            require ($vue);
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);  
        }
    }


        public static function projetAll() {
    
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_examinateur'] == 1) {
            $projets = ModelProjet::projetGetAllOnce($_SESSION['login_id']);

            $projets_unique = [];
            $seenLabels = [];
            foreach ($projets as $project) {
                $label = $project['label'];

                if (!in_array($label, $seenLabels)) {
                    $projets_unique[] = $project;
                    $seenLabels[] = $label;
                }
                
            } 
            
            if (empty($projets_unique)) {
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/creneau/viewCreneauByExaminateurNone.php';
                require ($vue);
                return;
            } else {

            // construction du chemin de la vue
            include 'config.php';
            
            $vue = $root . '/app/view/creneau/viewCreneauByProjetAll.php';
            require ($vue);
            }
            
            // checking that $projets is not empty
            
            } else {
              // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);  
            }
        }
        

    // cette fonction affiche un formulaire de sélection des projets du responsable connecté
    public static function projetPlanning() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            $projets = ModelProjet::getProjetByResponsableWithId($_SESSION['login_id']);
            $action = "projetPlanningStep2";
            $mode = "le planning"; // ces variables permet d'utiliser plusieurs fois la même vue

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewProjetSelectByResponsable.php';
            require ($vue);

        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);
        }
    }



    public static function rdvTake() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // l'utilisateur doit être un etudiant pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_etudiant'] == 1) {
            $projets = ModelProjet::getAllProper();



            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/rdv/viewRdvTake.php';
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
<!-- ----- fin ControllerProjet -->
