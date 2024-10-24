<?php

namespace App\Models;

use PDO;

class Profil_model extends \App\Model
{
    protected $_connexion;

    // Le constructeur accepte la connexion pour permettre les tests
    public function __construct(PDO $connexion = null)
    {
        $this->table = "Utilisateurs";
        
        if ($connexion === null) {
            $this->getConnection();
        } else {
            $this->_connexion = $connexion;
        }
    }

    public function findById()
    {
        session_start();
        $checkemail = $_SESSION["login_email"];

        $sql = "SELECT * FROM Utilisateurs WHERE uti_email = :login_email";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':login_email', $checkemail, PDO::PARAM_STR); 

        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>    