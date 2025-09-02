 
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

      <h1>L'ajout de l'examinateur a échoué.</h1>
      <p>Le nom d'utilisateur existe déjà, ou les informations fournies sont invalides (par exemple, vous avez peut être atteint la limite de caractères).</p>
      <a href="router1.php?action=examinateurAdd">Retentez l'ajout.</a>
      <br/><br/>
  </div>   
  
  
  <?php
  include $root . 'app/view/fragment/fragmentSoutenanceFooter.html';
  ?>

  <!-- ----- fin de la page -->

</body>
</html>