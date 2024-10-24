<?php

class Connexion_model extends Model
{
    public function __construct()
    {
        $this->getConnection();
    }
    
    public function loginaccount()
    {
        
        session_start();

        if (isset($_POST['login']) || isset($_POST['register']) || isset($_POST['retour'])) 
        {

            $login_email = $_POST['login_email'];
            $login_password = $_POST['login_password'];

            $sql = "SELECT uti_mdp FROM Utilisateurs WHERE uti_email = '$login_email'";

            $query = $this->_connexion->prepare($sql);
    
            $query->execute();

            $data = $query->fetch(PDO::FETCH_ASSOC);
            
            //var_dump($data);

            if (password_verify($login_password, $data['uti_mdp'])) { 
                
                echo 'Vous avez logged in!';

                $_SESSION["login_email"] = $login_email;
                $_SESSION["login_password"] = $login_password;

                ?><script>window.location.assign('http://localhost/profil');</script><?php
                die;
            }else{
                echo 'Vérifiez vos ajouts!';
                ?><script>window.location.assign('http://localhost/connexion');</script><?php
            }
        }
    }
}
?> 