<base href="http://localhost">
<?php session_start(); 
require_once 'auth_check.php';
    unset($_SESSION["login_email"]);
    unset($_SESSION["login_password"]);
    unset($_SESSION["admin_email"]);
    unset($_SESSION["admin_password"]);
    ?><script>window.location.assign('http://localhost/');</script><?php
?>