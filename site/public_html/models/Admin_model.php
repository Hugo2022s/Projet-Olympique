<?php

class Admin_model extends Model
{
    public function __construct()
    {
        $this->getConnection();
    }

    public function adminloginaccount()
    {
        
        session_start();

        if (isset($_POST['admin_login']) || isset($_POST['register']) || isset($_POST['retour'])) 
        {

            $admin_email = $_POST['admin_email'];
            $admin_password = $_POST['admin_password'];

            $sql = "SELECT ad_mdp FROM Admins WHERE ad_email = '$admin_email'";

            $query = $this->_connexion->prepare($sql);
    
            $query->execute();

            $data = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($admin_password, $data['ad_mdp'])) { 
                
                echo 'Vous avez logged in!';

                $_SESSION["admin_email"] = $admin_email;
                $_SESSION["admin_password"] = $admin_password;

                ?><script>window.location.assign('https://projetbloc3.com/config');</script><?php
                die;
            }else{
                echo 'Vérifiez vos ajouts!';
                ?><script>window.location.assign('https://projetbloc3.com/admin');</script><?php
            }
        }
    }
}
?> 