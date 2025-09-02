 
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
      <h1>Formulaire d'inscription</h1>
      <?php
      form_begin(' ', 'GET', 'router1.php');

      form_input_hidden("action", "personneSignin");

      form_checkbox("Responsable", "resp", "true");
      form_checkbox("Examinateur", "exa", "true");
      form_checkbox("Etudiant", "etu", "true");

      form_input_text("Nom", "nom", 40, "");
      form_input_text("Prénom", "prenom", 40, "");
      form_input_text("Login (nom d'utilisateur)", "login", 20, "");
      form_input_password("Mot de passe", "password", 20, "");
      

      form_input_reset("Reset");
      form_input_submit("S'inscrire");
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