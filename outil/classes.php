<?php
class Module implements WebBean {
    private $sigle;
    private $label;
    private $categorie;
    private $effectif;

    /* private $listeErreurs = array(); */

    // getX/setX
    function setSigle($sigle) {
        $this->sigle = $sigle;
    }
    function getSigle() {
        return $this->sigle;
    }
    function setLabel($label) {
        $this->label = $label;
    }
    function getLabel() {
        return $this->label;
    }
    function setEffectif($effectif) {
        $this->effectif = $effectif;
    }
    function getEffectif() {
        return $this->effectif;
    }
    function setCategorie($categorie) {
        $this->categorie = $categorie;
    }
    function getCategorie() {
        return $this->categorie;
    }
    

    function __construct($sigle, $label, $effectif, $categorie) {
        $this->setSigle($sigle);
        $this->setLabel($label);
        $this->setEffectif($effectif);
        $this->setCategorie($categorie);
    }

    function __toString() {
        return $this->getSigle() . " " . $this->getLabel() . " " . $this->getCategorie() . " " . $this->getEffectif();
    }


    static function pageKO() {
        echo Charte::html_head_bootstrap5("Incorrect");
        echo ("<h2>Votre formulaire n'est pas correct</h2>");
        /* foreach ($this->listeErreurs as $key => $value) {
            echo ("$key => $value <br/>\n");
        } */
        echo Charte::html_foot_bootstrap5();
    }

    public function pageOK() {
        echo Charte::html_head_bootstrap5("Module");
        echo ("<h2>Votre formulaire est correct</h2>");
        foreach ($this as $key => $value) {
            echo ("$key => $value <br/>\n");
        }
        echo '<h2>SauveTXT</h2>';
        echo $this->sauveTXT();
        echo '<h2>SauveBDR</h2>';
        echo $this->sauveBDR("modules");
        echo '<h2>createTable</h2>';
        echo $this->createTable("modules");
        echo Charte::html_foot_bootstrap5();
    }

    public function pageFoot() {
        echo Charte::html_foot_bootstrap5();
    }

    public function sauveTXT() {
        $resultat = $this->sigle . "; ";
        $resultat .= $this->label . "; ";
        $resultat .= $this->effectif . "; ";
        $resultat .= $this->categorie . "\n";
        return $resultat;
    }

    /* public function sauveXML() {
        $resultat = "<module>\n";
        $resultat .= "<sigle>" . $this->sigle . "</sigle>\n";
        $resultat .= "<label>" . $this->label . "</label>\n";
        $resultat .= "<effectif>" . $this->effectif . "</effectif>\n";
        $resultat .= "<categorie>" . $this->categorie . "</categorie>\n";
        $resultat .= "</module>\n";
        return $resultat;
    } */

    public function sauveBDR($table) {
        $resultat = "INSERT INTO " . $table . " VALUES (";
        $resultat .= "'" . $this->sigle . "',";
        $resultat .= "'" . $this->label . "',";
        $resultat .= "'" . $this->effectif . "',";
        $resultat .= "'" . $this->categorie . "');";
        return $resultat;
    }

    public function createTable($table) {
        $resultat = "CREATE TABLE " . $table . " (";
        $resultat .= "sigle varchar(6) NOT NULL, ";
        $resultat .= "categorie varchar(2) CHECK categorie IN ('CS', 'TM', 'EC', 'ME', 'CT'), ";
        $resultat .= "label varchar(40) NOT NULL, ";
        $resultat .= "effectif integer, ";
        $resultat .= "PRIMARY KEY(sigle)";
        $resultat .= ");";
        return $resultat;
    }
}

class Cursus {
    private $listeModules;



    function __construct() {
        $this->listeModules = array();
    }

    function __toString() {
        $resultat = "";
        foreach ($this->listeModules as $key => $value) {
            $resultat .= ("$key => $value <br/>\n");
        }
        return $resultat;
    }

    function addModule($module) {
        $this->listeModules[$module->getSigle()] = $module;
    }


    /* public function pageKO() {
        echo Charte::html_head_bootstrap5("Incorrect");
        echo ("<h2>Votre formulaire n'est pas correct</h2>");
        echo Charte::html_foot_bootstrap5();
    } */

    public function pageOK() {
        echo Charte::html_head_bootstrap5("Cursus");
        
        echo '<h2>Définition d\'un cursus</h2>';
        echo $this;
        echo '<h2>Affichage d\'un cursus</h2>';
        
        echo $this->affiche();
        
        echo Charte::html_foot_bootstrap5();
    }

    public function affiche() {
        echo "<pre>";
        print_r($this->listeModules);
        echo "</pre>";
    }

    public function pageFoot() {
        echo Charte::html_foot_bootstrap5();
    }

}



class Cursus2 {
    private $listeModules;



    function __construct() {
        $this->listeModules = array();
        if ( !empty( $_SESSION['SESSION_cursus'] ) ) {
            foreach ($_SESSION['SESSION_cursus'] as $module) {
                if ($module instanceof Module) {
                    $this->listeModules[$module->getSigle()] = $module;
                }
            }
        }
    }

    function __toString() {
        $resultat = "";
        foreach ($this->listeModules as $key => $value) {
            $resultat .= ("$key => $value <br/>\n");
        }
        return $resultat;
    }

    function addModule($module) {
        $this->listeModules[$module->getSigle()] = $module;
        $_SESSION['SESSION_cursus'][$module->getSigle()] = $module;
    }


    /* public function pageKO() {
        echo Charte::html_head_bootstrap5("Incorrect");
        echo ("<h2>Votre formulaire n'est pas correct</h2>");
        echo Charte::html_foot_bootstrap5();
    } */

    public function pageOK() {
        echo Charte::html_head_bootstrap5("Cursus");
        
        echo '<h2>Définition d\'un cursus</h2>';
        echo $this;
        echo '<h2>Affichage d\'un cursus</h2>';
        
        echo $this->affiche();

        echo '<a href="cursus_form2.php" class="btn btn-success m-1">Ajouter un autre module</a>';

        // ce lien permet de unset la variable de session SESSION_cursus
        echo '<a href="reset_session_cursus.php" class="btn btn-danger m-1">Supprimer tous les modules</a>';
        
        echo Charte::html_foot_bootstrap5();
    }

    public function affiche() {
        echo "<pre>";
        print_r($this->listeModules);
        echo "</pre>";
    }

    public function pageFoot() {
        echo Charte::html_foot_bootstrap5();
    }

}



interface WebBean {
    // public function valide();
    static function pageKO();
    public function pageOK();
    public function sauveTXT();
    // public function sauveXML();
    public function sauveBDR($table);
    
    
    public function createTable($table);
}

class Charte {

    static function html_head_bootstrap3($titre) {
    $resultat = "<html>\n";
    $resultat .= " <head>\n";
    $resultat .= "  <meta charset='UTF-8'>\n";
    $resultat .= "  <meta name='viewport' content='width=device-width, initial-scale=1.0'>\n";
    $resultat .= "  <link href='bootstrap.css' rel='stylesheet'/>\n";
    $resultat .= "  <link href='my_css.css' rel='stylesheet'/>\n";
    
    $resultat .= "  <title>$titre</title>\n";
    $resultat .= " </head>\n";
    
    $resultat .= " <body>\n";
    $resultat .= "   <div class = 'container'>\n";
    $resultat .= "    <div class='panel panel-success'>\n";
    $resultat .= "      <div class = 'panel-heading'>\n";
    $resultat .= "        <h3 class='panel-title'>$titre</h3>\n";
    $resultat .= "      </div>\n";
    $resultat .= "    </div> \n";
    return $resultat;
    }
    

    static function html_head_bootstrap5($titre) {
        $resultat = "<html lang='fr'>\n";
        $resultat .= "<head>\n";
        $resultat .= "    <meta charset='utf-8'>\n";
        $resultat .= "    <meta name='viewport' content='width=device-width, initial-scale=1'>\n";
        $resultat .= "    <title>" . $titre . "</title>\n";
        $resultat .= "    <link ";
        $resultat .= "        href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css' ";
        $resultat .= "        rel='stylesheet' ";
        $resultat .= "        integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD' ";
        $resultat .= "        crossorigin='anonymous'>\n";
        $resultat .= "    <link rel='stylesheet' href='../css/bootstrap53.min.css' type='text/css'/>\n";

        $resultat .= "</head>\n";
        $resultat .= "<body>\n";
        $resultat .= "    <div class='container'>\n";
        $resultat .= "    <h1>TD</h1>\n";
        $resultat .= "    <script ";
        $resultat .= "        src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' ";
        $resultat .= "        integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'>";
        $resultat .= "    </script>\n";

        $resultat .= "    <!-- include la navbar -->";
        $resultat .= "    <?php include 'nav.html'; ?>\n";
            

        $resultat .= "    <div class='mt-4 p-5 bg-primary text-white rounded'>\n";
        $resultat .= "        <h1>TD07 : PHP Objet</h1>\n";
        $resultat .= "    </div>\n";



        $resultat .= "    <p/><hr/>\n";
        $resultat .= "    <a id='exercice1'/>\n";
        $resultat .= "    <div class='card'>\n";
        $resultat .= "        <div class='card-body bg-info'>\n";
        $resultat .= "        <br/>\n";
        $resultat .= "        <div class='mx-lg-3'>\n";

        return $resultat;
    }
    
    
    static function html_foot_bootstrap3() {
    $resultat = "  <div/>\n";
    $resultat = "  <!-- Charte.html_foot_bootstrap() -->\n";
    $resultat .= " </body>\n";
    $resultat .= "</html>\n";
    return $resultat;
    }
    
    

    static function html_foot_bootstrap5() {
        $resultat = "            </div>";
        $resultat .= "        </div>";
        $resultat .= "    </div>";

        $resultat .= "    </div>";
        $resultat .= "    </div>";
        $resultat .= "    <p/><hr/><p/>";
        $resultat .= "    <small>Page de ROGER Lancelot rédigée le 19/04/2025</small>";
        $resultat .= "    <p/><hr/><p/>";
        $resultat .= "</body>";
        $resultat .= "</html>";

        return $resultat;
    }
}


?>