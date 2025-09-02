 
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

    <h1>Liste des examinateurs assignés à ce projet</h1>
    <br/>

   
    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
        </tr>
      </thead>
      <tbody>
          <?php
          foreach ($results as $element) {
            echo "<tr>";
            echo "<td>" . $element['nom'] . "</td>";
            echo "<td>" . $element['prenom'] . "</td>";
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