<base href="http://localhost">
<?php
    if(!isset($_SESSION["login_email"]) && !isset($_SESSION["login_password"]))
    {
        ?><script>window.location.assign('http://localhost');</script><?php
    }
    
?>