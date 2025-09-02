 
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

    <h1>Liste des creneaux de <?php echo $projets_unique[0]['examinateur']; ?></h1>
    <br/>

   
    <table class = "table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Creneau</th>
                    <th>Label du Projet</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets_unique as $projet): ?>
                    <tr>
                        <td><?php echo $projet['creneau']; ?></td>
                        <td><?php echo $projet['label']; ?></td>
                        <td><?php echo $projet['responsable']; ?></td>
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