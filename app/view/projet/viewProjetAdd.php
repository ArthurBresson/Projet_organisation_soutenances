 
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
      <h1>Formulaire de création d'un nouveau projet</h1>
      <?php
      form_begin(' ', 'GET', 'router1.php');

      form_input_hidden("action", "projetAdded");
      form_input_text("Label du projet", "label", 60, "");
      form_select("Nombre d'étudiants dans un groupe", "groupe", "", 1, array(1, 2, 3, 4, 5));

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