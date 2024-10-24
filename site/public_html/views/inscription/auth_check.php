<base href="https://projetbloc3.com">
<?php
    if((isset($_SESSION["login_email"]) && isset($_SESSION["login_password"])) || (isset($_SESSION["admin_email"]) && isset($_SESSION["admin_password"])))
    {
        ?><script>window.location.assign('https://projetbloc3.com');</script><?php
    }
    
?>