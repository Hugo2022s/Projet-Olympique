<?php

namespace App;

use PDO;
use PDOException;

abstract class Model {
    // infos bdd
    private $host = "localhost";
    private $db_name = ""; 
    private $username = "root";
    private $password = "";

    // propriété contenant la connexion
    protected $_connexion;

    // propriétés contenant les informations de requêtes
    public $table;
    public $id;

    // Constructeur pour accepter une instance PDO
    public function __construct(PDO $connection = null) {
        $this->_connexion = $connection;
        if (!$this->_connexion) {
            $this->getConnection();
        }
    }

    public function getConnection() {

        if ($this->_connexion) {
            return $this->_connexion;
        }
        try {
            $this->_connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec('set names utf8');
        } catch (PDOException $exception) {
            throw new PDOException('Erreur de connexion: ' . $exception->getMessage());
        }
    }

    public function getAll() {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
}
?>