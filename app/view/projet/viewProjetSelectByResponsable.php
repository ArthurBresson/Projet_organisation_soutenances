 
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

      echo "<h1>Sélectionnez le projet dont vous voulez voir " . $mode . "</h1>";

      form_begin(' ', 'GET', 'router1.php');

      form_input_hidden("action", $action); ?>

      <label for="projet_id">Projet : </label> <select class="form-control" id='projet_id' name='projet_id' style="width: 350px">
            <?php
              foreach ($projets as $element) {
                printf("<option value='%d'>%s</option>", $element["id"], $element["label"]);
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