 
<!-- ----- debut de la page -->
<?php include 'fragment/fragmentSoutenanceHeader.html'; ?>
<body>
  <div class="container">
    <?php  
    include 'menu/viewMenu.php';
    
    include 'fragment/fragmentSoutenanceJumbotron.html';
    ?>

    <h1>Proposition de plusieurs fonctionnalités originales</h1>
    <h3>1.</h3>
    <p>Permettre aux utilisateurs de <b>mettre à jour leurs informations</b>.<br/>
    En premier lieu, les informations comme le nom et le prénom, le mot de passe et le nom d'utilisateur (si disponible).<br/>
    Les responsables pourraient également changer les informations relatives aux projets, aux soutenances, etc...<br/></p>

    <h3>2.</h3>
    <p>Permettre aux utilisateurs de <b>définir une image de profil</b>.<br/>
    Cela peut être réalisé en créant un répertoire contenant toutes les images de profil.<br/>
    Lors de la création de son compte ou quand il met à jour ses informations, l'utilisateur peut envoyer une image sur le serveur et en faire sa photo de profil.<br/>
    Cette image possède un nom unique définit à partir de l'ID de l'utilisateur, qui est lui aussi unique.<br/>
    Si on veut afficher l'image de profil, on peut obtenir son chemin grâce à l'identifiant de l'utilisateur connecté.<br/></p>

    <h3>3.</h3>
    <p>De la même façon, on peut permettre aux utilisateurs de <b>définir une image d'illustration pour leur projet</b>.<br/>
    Cela peut être réalisé en créant un répertoire contenant toutes les illustrations.<br/>
    Lors de la création ou de la mise à jour d'un projet, l'utilisateur peut envoyer une image sur le serveur.<br/>
    Cette image possède un nom unique définit à partir de l'ID du projet, qui est lui aussi unique.<br/>
    Lors de l'affichage du projet, le chemin vers l'image peut être utilisé pour l'afficher avec le reste des informations.<br/></p>
    <br/>


  </div>
  
  <?php
  include 'fragment/fragmentSoutenanceFooter.html';
  ?>

  <!-- ----- fin de la page -->

</body>
</html>