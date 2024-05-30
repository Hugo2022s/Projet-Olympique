<?php

abstract class Model{
    // infos bdd
    private $host = "localhost";
    private $db_name = "dbfd0l8ogdmk2d"; 
    private $username = "um7algzyavaxt";
    private $password = "5endqmagafo3";

    // propriété contenant la connexion
    protected $_connexion;

    // propriétés contenant les informations de requêtes
    public $table;
    public $id;

    public function getConnection(){
        $this->_connexion = null;

        try{
            $this->_connexion = new PDO('mysql:host='. $this->host . '; dbname=' . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec('set names utf8');
        }catch(PDOException $exception){
            echo 'Erreur de connexion: ' . $exception->getMessage();
        }
    }

    public function getAll(){
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}


