 
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
      <h1>Formulaire d'ajout d'un examinateur</h1>
      <?php
      form_begin(' ', 'GET', 'router1.php');

      form_input_hidden("action", "examinateurAdded");
      form_input_text("Nom", "nom", 40, "");
      form_input_text("Prénom", "prenom", 40, "");
      form_input_text("Nom d'utilisateur (obligatoire, 20 caractères maximum)", "login", 20, "");

      form_input_reset("Reset");
      form_input_submit("Confirmer");
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