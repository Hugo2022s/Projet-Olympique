<base href="https://projetbloc3.com">
<?php session_start(); 
require_once 'auth_check.php';
    unset($_SESSION["login_email"]);
    unset($_SESSION["login_password"]);
    unset($_SESSION["admin_email"]);
    unset($_SESSION["admin_password"]);
    ?><script>window.location.assign('https://projetbloc3.com');</script><?php
?>