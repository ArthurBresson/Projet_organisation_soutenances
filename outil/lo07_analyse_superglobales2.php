<?php 
  /* important */
  require_once 'classes.php'; // assuming the class is defined in this file BEFORE SESSION START (serialize stuff or whatever)
  session_start();
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TD04</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
        crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap53.min.css" type="text/css"/>

  </head>
  <body>
    <div class="container">
      <h1>TD</h1>
      <script 
          src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
      </script>

    

      <div class="mt-4 p-5 bg-primary text-white rounded">
        <h1>Présentation des superglobales $_GET, $_POST, $_COOKIE et $_SESSION</h1>
      </div>



      <p/><hr/>
      <a id='exercice1'/>
      <div class="card">
        <div class="card-body bg-info">
          <!-- <h5 class="card-title">Exercice 4 : Analyse générique de formulaires Web</h5> -->
          <br/>
          <div class='mx-lg-3'>

          
          <!-- Variable GET -->
          <p class="text-danger"><b>$_GET</b></p>
          <?php
            
              if (!empty($_GET)) {
                echo '<table class="table w-50">
                        <thead>
                            <tr class="table-warning">
                            <th scope="col">#</th>
                            <th scope="col">Clé</th>
                            <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>';
                $i = 1;
                foreach ($_GET as $key => $value) {
                if (isset($value)) {

                    $variable = $value;
                    
                    } else {
                    
                    $variable = '';
                    
                    } 
                echo '<tr class="table-secondary">';
                echo '<th scope="row">' . $i . '</th>';
                echo '<td>' . $key .'</td>';
                if (gettype($variable) == "array") {
                    echo '<td>' . implode(", ", $variable) . '</td>';
                } else {
                    echo '<td>' . $variable . '</td>';
                }
                echo '</tr>';
                $i += 1;
                }
                echo '</tbody>
                    </table>';

              } else { /* On n'affiche pas le tableau */
                echo '<p><b>Variable $_GET non initialisée/vide</b></p>';
              }
            
            
          ?>

          <!-- Variable POST -->
          <p class="text-danger"><b>$_POST</b></p>
          <?php
            
              if (!empty($_POST)) {
                echo '<table class="table w-50">
                        <thead>
                            <tr class="table-warning">
                            <th scope="col">#</th>
                            <th scope="col">Clé</th>
                            <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>';
                $i = 1;
                foreach ($_POST as $key => $value) {
                if (isset($value)) {

                    $variable = $value;
                    
                    } else {
                    
                    $variable = '';
                    
                    } 
                echo '<tr class="table-secondary">';
                echo '<th scope="row">' . $i . '</th>';
                echo '<td>' . $key .'</td>';
                if (gettype($variable) == "array") {
                    echo '<td>' . implode(", ", $variable) . '</td>';
                } else {
                    echo '<td>' . $variable . '</td>';
                }
                echo '</tr>';
                $i += 1;
                }
                echo '</tbody>
                    </table>';

              } else { /* On n'affiche pas le tableau */
                echo '<p><b>Variable $_POST non initialisée/vide</b></p>';
              }
            
            
          ?>


          <!-- Variable COOKIE -->
          <p class="text-danger"><b>$_COOKIE</b></p>
          <?php
            
              if (!empty($_COOKIE)) {
                echo '<table class="table w-50">
                        <thead>
                            <tr class="table-warning">
                            <th scope="col">#</th>
                            <th scope="col">Clé</th>
                            <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>';
                $i = 1;
                foreach ($_COOKIE as $key => $value) {
                if (isset($value)) {

                    $variable = $value;
                    
                    } else {
                    
                    $variable = '';
                    
                    } 
                echo '<tr class="table-secondary">';
                echo '<th scope="row">' . $i . '</th>';
                echo '<td>' . $key .'</td>';
                if (gettype($variable) == "array") {
                    echo '<td>' . implode(", ", $variable) . '</td>';
                } else {
                    echo '<td>' . $variable . '</td>';
                }
                echo '</tr>';
                $i += 1;
                }
                echo '</tbody>
                    </table>';

              } else { /* On n'affiche pas le tableau */
                echo '<p><b>Variable $_COOKIE non initialisée/vide</b></p>';
              }
            
            
          ?>


          <!-- Variable SESSION -->
          <p class="text-danger"><b>$_SESSION</b></p>
          <?php
            
              if (!empty($_SESSION)) {
                echo '<table class="table w-50">
                        <thead>
                            <tr class="table-warning">
                            <th scope="col">#</th>
                            <th scope="col">Clé</th>
                            <th scope="col">Valeur</th>
                            </tr>
                        </thead>
                        <tbody>';
                $i = 1;
                foreach ($_SESSION as $key => $value) {
                if (isset($value)) {

                    $variable = $value;
                    
                    } else {
                    
                    $variable = '';
                    
                    } 
                echo '<tr class="table-secondary">';
                echo '<th scope="row">' . $i . '</th>';
                echo '<td>' . $key .'</td>';
                if (gettype($variable) == "array") {
                    echo '<td>' . implode(", ", $variable) . '</td>';
                } else {
                    echo '<td>' . $variable . '</td>';
                }
                echo '</tr>';
                $i += 1;
                }
                echo '</tbody>
                    </table>';

              } else { /* On n'affiche pas le tableau */
                echo '<p><b>Variable $_SESSION non initialisée/vide</b></p>';
              }
            
            
          ?>

          </div>
        </div>
      </div>

    </div>
    </div>
    <!-- ================================================================================================================ -->
    <p/><hr/><p/>
    <small>Page de BRESSON Arthur rédigée le 08/04/2025</small>
    <p/><hr/><p/>
  </body>
</html>
