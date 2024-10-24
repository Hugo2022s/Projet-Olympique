<base href="https://projetbloc3.com">
<?php
    if(!isset($_SESSION["login_email"]) && !isset($_SESSION["login_password"]))
    {
        ?><script>window.location.assign('https://projetbloc3.com');</script><?php
    }
    
?>