<!-- ----- debut ControllerCreneau -->
<?php
require_once '../model/ModelCreneau.php';
require_once '../model/ModelProjet.php';

class ControllerCreneau {


    public static function creneauAll(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SESSION['roles']['role_examinateur'] == 1) {
            $projets = ModelCreneau::creneauxGetAllByExaminateur($_SESSION['login_id']);
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
                include 'config.php';
                $vue = $root . '/app/view/creneau/viewCreneauByExaminateurNone.php';
                require ($vue);
                return;
            }else{

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/creneau/viewCreneauByExaminateur.php';
            require ($vue);
            }
             
            }   else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            if (DEBUG)
            echo ("ControllerProjet : creneauExaminateurAll : vue = $vue");
            require ($vue);  
    }
        }

    
    
    public static function creneauProjetAll(){
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
            }else{

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewSelectProjet.php';
            require ($vue);
            }
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            if (DEBUG)
            echo ("ControllerProjet : projetSelected : vue = $vue");
            require ($vue);  
        }
    }
    
    public static function projetSelected() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
        
        // l'utilisateur doit être un examin pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_examinateur'] == 1) {
            include 'config.php';
            $label_projet = $_GET['label'];
            $projets_unique = ModelCreneau::creneauByProjet($_SESSION['login_id'],$label_projet);
            
            if (empty($projets_unique)) {
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/creneau/viewCreneauByProjetNone.php';
                if (DEBUG)
                echo ("ControllerProjet : creneauExaminateurAll : vue = $vue");
                require ($vue);
                return;
            }else{

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/creneau/viewCreneauByExaminateur.php';
            require ($vue);
            }   
        }
    }

    public static function rdvTakeStep2() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // l'utilisateur doit être un étudiant pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_etudiant'] == 1) {
            
            $creneaux = ModelCreneau::selectByProjet($_GET['projet_id']);

            if (empty($creneaux)) {
                // ----- Construction chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/rdv/viewRdvTakeNone.php';
                require ($vue);
                return;
            }

            // construire la vue
            include 'config.php';
            $vue = $root . '/app/view/rdv/viewRdvTakeStep2.php';
            require ($vue);

        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            if (DEBUG)
            echo ("ControllerProjet : creneauExaminateurAll : vue = $vue");
            require ($vue);  
        }
    }
    
    public static function creneauAdd(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
        
        // l'utilisateur doit être un examin pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_examinateur'] == 1) {
            include 'config.php';
            $projets = ModelProjet::projetGetAllOnceForAll($_SESSION['login_id']);
            
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
            }else{

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/creneau/viewCreneauAdd.php';
            require ($vue);
            }
    
        }else {
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/viewSoutenanceForbidden.php';
                if (DEBUG)
                echo ("ControllerProjet : creneauExaminateurAll : vue = $vue");
                require ($vue);  
            }
    }
    
    public static function creneauAdded(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if (($_SESSION['roles']['role_examinateur'] == 1) &&(!empty($_GET['date']) ) &&(!empty($_GET['heure']) )) {
           
            
            $dateheure = $_GET['date']." ".$_GET['heure'].':00';
            
            $projet_id = ModelProjet::getProjectIdByLabel($_GET['label']);
            
            $results = ModelCreneau::insertCreneau($projet_id,$_SESSION['login_id'], $dateheure);

            if ($results == -1) { 
                include 'config.php';
                $vue = $root . '/app/view/creneau/viewCreneauAddError.php';
                require ($vue);
                return;
            }else{
            
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/creneau/viewCreneauAdded.php';
            require ($vue);
            }

        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/creneau/viewCreneauAddError.php';
            require ($vue);  
        }
    }
    

    
    public static function creneauAddSeveral(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } 
        
        // l'utilisateur doit être un examin pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_examinateur'] == 1) {
            include 'config.php';
            $projets = ModelProjet::projetGetAllOnce($_SESSION['login_id']);
            
            if (!empty($projets)) {
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/creneau/viewCreneauAddSeveral.php';
                if (DEBUG)
                echo ("ControllerProjet : creneauExaminateurAll : vue = $vue");
                require ($vue);
                return;
            }
            else{
            
                // ----- Construction chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/creneau/viewCreneauAddSeveralError.php';
                require ($vue);
            }
        }else {
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/viewSoutenanceForbidden.php';
                if (DEBUG)
                echo ("ControllerProjet : creneauExaminateurAll : vue = $vue");
                require ($vue);  
            }
    }
    
    public static function creneauAddedSeveral(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_examinateur'] == 1 &&(!empty($_GET['date']) ) &&(!empty($_GET['heure']) )) {
            $dateheure = $_GET['date']." ".$_GET['heure'].':00';
            
            $projet_id = ModelProjet::getProjectIdByLabel($_GET['label']);
            
            $results = ModelCreneau::insertCreneau($projet_id,$_SESSION['login_id'], $dateheure);

            if ($results == -1) { 
                include 'config.php';
                $vue = $root . '/app/view/creneau/viewCreneauAddError.php';
                require ($vue);
                return;
            }else{
            
            $i = 1;
            while($i<$_GET['nb_creneau']){
                $date_originale_str = $dateheure; // Par exemple "2025-06-18"
                $datetime_complet_obj = new DateTime($date_originale_str );
                $datetime_complet_obj->modify('+'.$i.' hour');
                $nouveau_datetime_str = $datetime_complet_obj->format('Y-m-d H:i:s');
            
                $projet_id = ModelProjet::getProjectIdByLabel($_GET['label']);

                $results = ModelCreneau::insertCreneau($projet_id,$_SESSION['login_id'], $nouveau_datetime_str);

                if ($results == -1) { 
                    include 'config.php';
                    $vue = $root . '/app/view/creneau/viewCreneauAddSeveralError.php';
                    require ($vue);
                    return;
                }else{
                $i++;
                }
            }
            // ----- Construction chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/creneau/viewCreneauAdded.php';
            require ($vue);
            }

        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/creneau/viewCreneauAddSeveralError.php';
            require ($vue);  
        }
            
    }


 
}
?>
<!-- ----- fin ControllerCreneau -->
