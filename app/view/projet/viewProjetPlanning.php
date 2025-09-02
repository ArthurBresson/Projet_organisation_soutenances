 
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

    <h1>Liste des rendez-vous planifiés pour ce projet</h1>
    <br/>

   



    <table class = "table table-striped table-bordered">
      <thead>
        <tr>
          <th>Créneau horaire</th>
          <th>Examinateur</th>
          <th>Etudiant(s)</th>
        </tr>
      </thead>
      <tbody>
    <?php
    // Group and display by creneau_datetime
    $current_creneau = null;

    foreach ($results as $key => $row) {
        if ($row['creneau_datetime'] !== $current_creneau) {
            echo "<tr>";
            $current_creneau = $row['creneau_datetime'];
            echo "<td>" . htmlspecialchars($current_creneau) . "</td>";
            echo "<td>" . htmlspecialchars($row['examinateur_nom']) . " " . htmlspecialchars($row['examinateur_prenom']) . "</td>";
            echo "<td>";
        }

        echo $row['etudiant_nom'] . " " . $row['etudiant_prenom'] . "<br/>";

        // Check if the next row is a new creneau to close the list
        if (!isset($results[$key + 1]) || $results[$key + 1]['creneau_datetime'] !== $current_creneau) {
            echo "</td>";
            echo "</tr>";
        }

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