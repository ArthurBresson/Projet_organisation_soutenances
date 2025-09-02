 
<!-- ----- debut de la page -->
<?php include 'fragment/fragmentSoutenanceHeader.html'; ?>
<body>
  <div class="container">
    <?php  
    include 'menu/viewMenu.php';
    
    include 'fragment/fragmentSoutenanceJumbotron.html';
    ?>

    <h1>Proposition d'une amélioration du code MVC</h1>
    <p>Le routeur du modèle est construit autour de la méthode GET, qui est très peu sécurisée pour les informations confidentielles. Même si la méthode POST reste également non sécurisée pour un système de connexion, elle reste plus appropriée pour les informations confidentielles.<br/>
    On pourrait reconstruire le routeur afin d'utiliser plusieurs méthodes d'envoie des données et d'ainsi avoir un système plus fexible.<br/>
    Idéalement, les informations envoyées devraient être cryptées.</p>
    <br/>


  </div>
  
  <?php
  include 'fragment/fragmentSoutenanceFooter.html';
  ?>

  <!-- ----- fin de la page -->

</body>
</html>