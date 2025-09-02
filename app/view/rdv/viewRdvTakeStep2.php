 
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
      <?php

      echo "<h1>Sélectionnez le créneau que vous voulez prendre</h1>";

      form_begin(' ', 'GET', 'router1.php');

      form_input_hidden("action", "rdvTaken");
      ?>

      <label for="projet_id">Créneau : </label> <select class="form-control" id='creneau_id' name='creneau_id' style="width: 350px">
            <?php
              foreach ($creneaux as $element) {
                printf("<option value='%d'>%s avec %s %s</option>", $element["creneau_id"], $element["creneau_datetime"], $element["examinateur_prenom"], $element["examinateur_nom"]);
              }
            ?>
        </select>
        <br/>

      <?php

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