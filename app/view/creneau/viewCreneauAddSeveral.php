 
<!-- ----- debut de la page -->
<?php
include $root . 'app/view/fragment/fragmentSoutenanceHeader.html'; 
// bibliothèque de fonctions utiles pour les formulaires
require_once $root . 'public/lib/lo07_biblio_formulaire.php';
?>
<body>
  <div class="container">
    <?php
    include $root . 'app/view/menu/viewMenu.php';
    include $root . 'app/view/fragment/fragmentSoutenanceJumbotron.html';
    ?>

    <div>
      <h1>Formulaire de création de plusieurs creneaux</h1>
      <?php
      form_begin(' ', 'GET', 'router1.php');

      form_input_hidden("action", "creneauAddedSeveral");
      form_datalist_projet("label du projet", "label", $projets);
      form_date("date", "date", "");
      form_time("heure de depart", "heure", "");
      form_input_number("Nombre de creneaux","nb_creneau");
      
      form_input_reset("Reset");
      form_input_submit("Valider");
      form_end();

      ?>
    <br/>
    </div>
  </div>   
  
  
  <?php
  include $root . 'app/view/fragment/fragmentSoutenanceFooter.html';
  ?>

  <!-- ----- fin de la page -->

</body>
</html>