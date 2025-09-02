 
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

      <h1>L'inscription a échoué</h1>
      <p>Les informations fournies sont peut être invalides (par exemple, vous avez peut être atteint la limite de caractères).</p>
      <a href="router1.php?action=personneSigninForm">Retentez l'inscription.</a>
      <br/><br/>
  </div>   
  
  
  <?php
  include $root . 'app/view/fragment/fragmentSoutenanceFooter.html';
  ?>

  <!-- ----- fin de la page -->

</body>
</html>