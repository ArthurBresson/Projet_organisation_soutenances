 
<!-- ----- debut de la page -->
<?php
include $root . 'app/view/fragment/fragmentSoutenanceHeader.html'; 
?>
<body>
  <div class="container">
    <?php
    include $root . 'app/view/menu/viewMenu.php';
    include $root . 'app/view/fragment/fragmentSoutenanceJumbotron.html';
    ?>

    <div>
      <h1>Une erreur est survenue lors de l'ajout du rendez-vous.</h1>
      <p>Certains champs sont invalides.</p>
      <a href="router1.php?action=rdvTake">Réessayer</a>
    <br/><br/>
    </div>
  </div>   
  
  
  <?php
  include $root . 'app/view/fragment/fragmentSoutenanceFooter.html';
  ?>

  <!-- ----- fin de la page -->

</body>
</html>