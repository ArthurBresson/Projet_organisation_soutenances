<!-- ----- debut Router1 -->
<?php

require ('../controller/ControllerSoutenance.php');
require ('../controller/ControllerPersonne.php');
require ('../controller/ControllerRdv.php');
require ('../controller/ControllerCreneau.php');
require ('../controller/ControllerProjet.php');


// --- récupération de l'action passée dans l'URL
$query_string = $_SERVER['QUERY_STRING'];

// fonction parse_str permet de construire 
// une table de hachage (clé + valeur)
parse_str($query_string, $param);

// --- $action contient le nom de la méthode statique recherchée
$action = htmlspecialchars($param["action"]);

// --- Liste des méthodes autorisées
switch ($action) {
    case "personneLoginForm" :
    case "personneLogin" :
    case "personneLogout" :
    case "personneSigninForm" :
    case "personneSignin" :
    case "examinateurAll" :
    case "examinateurAdd" :
    case "examinateurAdded" :
    case "listeExaminateur" :
    case "projetExaminateurStep2" :
        ControllerPersonne::$action();
        break;
        
    case "fonctionnaliteOriginale" :
    case "ameliorationCode" :
        ControllerSoutenance::$action();
        break;
        
    case "rdvAll" :
    case "projetPlanningStep2" :
    case "rdvTaken" :
        ControllerRdv::$action();
        break;
        
    case "creneauAll" :
    case "creneauProjetAll" :
    case "projetSelected" :
    case "creneauAdd" :
    case "creneauAdded" :
    case "creneauAddSeveral" :
    case "creneauAddedSeveral" :
    case "rdvTakeStep2" :
        ControllerCreneau::$action();
        break;
        
    case "projetAll" :
    case "projetAdd" :
    case "projetAdded" :
    case "projetResponsableAll" :
    case "projetExaminateur" :
    case "projetPlanning" :
    case "rdvTake" :
        ControllerProjet::$action();
        break;


 // Tache par défaut
 default:
  $action = "soutenanceAccueil";
  ControllerSoutenance::$action();
}
?>
<!-- ----- Fin Router1 -->