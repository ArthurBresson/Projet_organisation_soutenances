<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} // making sure session is started

// initializing login id for later on
$_SESSION['login_id'] = 0;
$_SESSION['utilisateur'] = '?';
header('Location: app/router/router1.php?action=truc');

?>