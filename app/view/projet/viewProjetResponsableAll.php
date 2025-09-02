 
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

    <h1>Vos projets</h1>
    <br/>

   
    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th>Label</th>
          <th>Responsable</th>
          <th>Taille du groupe</th>
        </tr>
      </thead>
      <tbody>
          <?php
          foreach ($projets as $element) {
            echo "<tr>";
            echo "<td>" . $element['label'] . "</td>";
            echo "<td>" . $element['nom'] . " " . $element['prenom'] . "</td>";
            echo "<td>" . $element['groupe'] . "</td>";
            echo "</tr>";
          }
          ?>
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