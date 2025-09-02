<!-- ----- debut ControllerSoutenance -->
<?php

class ControllerSoutenance {
        // --- page d'acceuil
        public static function soutenanceAccueil() {
        include 'config.php';

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        if (!isset($_SESSION['login_id'])) {
            $_SESSION['login_id'] = 0;
        }

        $vue = $root . '/app/view/viewSoutenanceAccueil.php';
        if (DEBUG)
        echo ("ControllerVin : soutenanceAccueil : vue = $vue");
        require ($vue);
    }


    public static function fonctionnaliteOriginale() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewSoutenanceOriginale.php';
        require ($vue);
    }


    public static function ameliorationCode() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/viewSoutenanceAmelioration.php';
        require ($vue);
    }


 
}
?>
<!-- ----- fin ControllerSoutenance -->
