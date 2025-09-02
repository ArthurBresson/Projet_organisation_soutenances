 
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

    <h1>Liste des projets de <?php echo $projets_unique[0]['nom_examinateur']; ?></h1>
    <br/>

   
    <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Label du Projet</th>
                    <th>Nom de l'Examinateur</th>
                    <th>Taille du Groupe</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets_unique as $projet): ?>
                    <tr>
                        <td><?php echo $projet['label_projet']; ?></td>
                        <td><?php echo $projet['nom_examinateur']; ?></td>
                        <td><?php echo $projet['taille_groupe']; ?></td>
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