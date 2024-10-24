<?php

namespace App\Models;

use PDO;

class Admin_model extends \App\Model
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

    public function adminloginaccount()
{
    session_start();

    if (isset($_POST['admin_login']) || isset($_POST['register']) || isset($_POST['retour'])) 
    {
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];

        $sql = "SELECT ad_mdp FROM Admins WHERE ad_email = :admin_email";
        $query = $this->_connexion->prepare($sql);
        $query->bindParam(':admin_email', $admin_email);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data && password_verify($admin_password, $data['ad_mdp'])) 
        { 
            $_SESSION["admin_email"] = $admin_email;
            $_SESSION["admin_password"] = $admin_password;

            
            return 'Vous avez logged in!';
        } else {
           
            return 'Vérifiez vos ajouts!';
        }
    }

    return "Aucune action n'a été effectuée.";
}

}

?>
