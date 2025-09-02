 
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

    <h1>Liste des rdv de <?php echo $projets[0]['nom_etudiant']; ?></h1>
    <br/>

   
    <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Label du projet</th>
                    <th>creneau</th>
                    <th>Examinateur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets as $projet): ?>
                    <tr>
                        <td><?php echo $projet['label_projet']; ?></td>
                        <td><?php echo $projet['creneau_creneau']; ?></td>
                        <td><?php echo $projet['nom_examinateur']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <br/>


  </div>   
  
  
  <?php
  include $root . 'app/view/fragment/fragmentSoutenanceFooter.html';
  ?>

  <!-- ----- fin de la page -->

</body>
</html>