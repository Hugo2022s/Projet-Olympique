<?php

namespace App\Models;

use PDO;

class Logout_model extends \App\Model
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
}
?>    