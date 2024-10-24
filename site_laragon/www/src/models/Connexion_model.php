<?php
namespace App\Models;

use PDO;

class Connexion_model extends \App\Model
{
    protected $_connexion;

    // Le constructeur accepte la connexion pour permettre les tests
    public function __construct(PDO $connexion = null)
    {
     
        if ($connexion === null) {
            $this->getConnection();
        } else {
            $this->_connexion = $connexion;
        }
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
            
            

            if (password_verify($login_password, $data['uti_mdp'])) { 

                $_SESSION["login_email"] = $login_email;
                $_SESSION["login_password"] = $login_password;

                
            return 'Vous avez logged in!';
        } else {
        
            return 'Vérifiez vos ajouts!';
        }
    }

    return "Aucune action n'a été effectuée.";
}
}
?> 