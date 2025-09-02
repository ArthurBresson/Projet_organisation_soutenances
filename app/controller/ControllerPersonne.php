<!-- ----- debut ControllerPersonne -->
<?php
require_once '../model/ModelPersonne.php';

class ControllerPersonne {

    // -- affiche la page de login
    public static function personneLoginForm() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/personne/viewPersonneLoginForm.php';
        if (DEBUG)
        echo ("ControllerPersonne : personneLoginForm : vue = $vue");
        require ($vue);
    }


    // gère le login
    public static function personneLogin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // on récupère les données du formulaire
        $username = $_GET['username'];
        $password = $_GET['password'];

        if (ModelPersonne::checkCredentials($username, $password) == 1) {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/personne/viewPersonneLoggedIn.php';
            if (DEBUG)
            echo ("ControllerPersonne : personneLogin : vue = $vue");
            require ($vue);
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/personne/viewPersonneLoginError.php';
            if (DEBUG)
            echo ("ControllerPersonne : personneLogin : vue = $vue");
            require ($vue);
        }
    }


    // affiche la page de logout
    public static function personneLogout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        $_SESSION['login_id'] = 0;
        // construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/personne/viewPersonneLogout.php';
        if (DEBUG)
        echo ("ControllerPersonne : personneLogout : vue = $vue");
        require ($vue);
    }


    // affiche la page de sign in
    public static function personneSigninForm() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        $_SESSION['login_id'] = 0;
        // construction du chemin de la vue
        include 'config.php';
        $vue = $root . '/app/view/personne/viewPersonneSigninForm.php';
        if (DEBUG)
        echo ("ControllerPersonne : personneSigninForm : vue = $vue");
        require ($vue);
    }


    // gère le sign in
    public static function personneSignin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started

        // on récupère les données du formulaire
        if (isset($_GET['resp'])) {
            $resp = true;
        } else {
            $resp = false;
        }
        if (isset($_GET['exa'])) {
            $exa = true;
        } else {
            $exa = false;
        }
        if (isset($_GET['etu'])) {
            $etu = true;
        } else {
            $etu = false;
        }
        $nom = $_GET['nom'];
        $prenom = $_GET['prenom'];
        $login = $_GET['login'];
        $password = $_GET['password'];

        $results = ModelPersonne::insert($nom, $prenom, $resp, $exa, $etu, $login, $password);
        if ($results == -2) { // alors le nom d'utilisateur existe déjà
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/personne/viewPersonneSigninUsernameError.php';
            if (DEBUG)
            echo ("ControllerPersonne : personneSignin : vue = $vue");
            require ($vue);
        } else if ($results == -1) { // erreur dans la base de données
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/personne/viewPersonneSigninError.php';
            if (DEBUG)
            echo ("ControllerPersonne : personneSignin : vue = $vue");
            require ($vue);
        } else { // succès
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/personne/viewPersonneSignedin.php';
            if (DEBUG)
            echo ("ControllerPersonne : personneSignin : vue = $vue");
            require ($vue);
        }
    }
    
    

    public static function examinateurAll() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            $results = ModelPersonne::getAllExaminateur();

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/personne/viewPersonneExaminateurAll.php';
            require ($vue);
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);  
        }
    }


    public static function projetExaminateurStep2() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            $results = ModelPersonne::getExaminateurByProjet($_GET['projet_id']);

            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/projet/viewProjetExaminateurStep2.php';
            require ($vue);
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);  
        }
    }


    static public function examinateurAdd() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/personne/viewPersonneExaminateurAdd.php';
            require ($vue);
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);  
        }
    }


    static public function examinateurAdded() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        } // making sure session is started
        
        // l'utilisateur doit être un responsable pour pouvoir utiliser cette fonction
        if ($_SESSION['roles']['role_responsable'] == 1) {
            $nom = strtoupper($_GET['nom']);
            $prenom = strtolower($_GET['prenom']);

            // le mot de passe par défaut est secret
            $results = ModelPersonne::insert($nom, $prenom, false, true, false, $_GET['login'], "secret");

            if ($results == -2) { // alors le nom d'utilisateur existe déjà/les données sont incorrectes
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/personne/viewPersonneExaminateurAddError.php';
                require ($vue);
            } else if ($results == -1) { // erreur dans la base de données
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/personne/viewPersonneExaminateurAddError.php';
                require ($vue);
            } else { // success
                // construction du chemin de la vue
                include 'config.php';
                $vue = $root . '/app/view/personne/viewPersonneExaminateurAdded.php';
                require ($vue);
            }
        } else {
            // construction du chemin de la vue
            include 'config.php';
            $vue = $root . '/app/view/viewSoutenanceForbidden.php';
            require ($vue);  
        }
    }
 
}
?>
<!-- ----- fin ControllerPersonne -->
