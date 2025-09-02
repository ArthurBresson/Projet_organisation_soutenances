<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="router1.php?action=SoutenanceAccueil">ROGER Lancelot || BRESSON Arthur</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
<?php

include '../controller/config.php';
require_once '../model/ModelPersonne.php';


    if(isset ($_SESSION)){
        $id = $_SESSION['login_id'];
    }else{
        $id = 0;
    }
    
    
    $roles = ModelPersonne::getRole($id);
    $_SESSION['roles'] = $roles; // on aura ça dans chaque page
 //  echo '<pre>';
//var_dump($roles);
//echo '</pre>';
//exit;
    
    $viewsToInclude = [];
    
    if ($id == 0) {
            $viewsToInclude[] = 'viewDefault.php'; 
        foreach ($viewsToInclude as $vue) {
            
            include $vue; 
        }


    }else{
        $roleView = [
            'role_responsable' => 'viewResponsable.php',
            'role_examinateur' => 'viewExaminateur.php',
            'role_etudiant'    => 'viewEtudiant.php',
        ];
        
        foreach ($roles as $roleKey => $val){
            if ($val === 1 && isset($roleView[$roleKey])) { 
                $viewsToInclude[] = $roleView[$roleKey]; 
            }
        }
          //echo '<pre>';
//var_dump($viewsToInclude);
//echo '</pre>';
//exit;

        foreach ($viewsToInclude as $vue) {
            
            include $vue; 
            
        }
        include 'viewConnected.php';
        
    }
?>
 
            
