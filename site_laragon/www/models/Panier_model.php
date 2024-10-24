<?php

class Panier_model extends Model
{
    public function __construct()
    {
        $this->getConnection();
    }

    public function findByUser()
    {
        session_start();
        $user_id = $_SESSION["login_id"];

        $sql = "SELECT *, Utilisateurs.uti_cle AS user_cle, Achats.ach_cle AS achat_cle 
                FROM Achats 
                JOIN Utilisateurs ON Achats.ach_uti_id = Utilisateurs.uti_id 
                WHERE ach_uti_id = :login_id";

        $query = $this->_connexion->prepare($sql);

        $query->bindValue(':login_id', $user_id, PDO::PARAM_INT); 

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

/*Code pour fonctions séparées 

    public function findByUser()
    {
        session_start();
        $user_id = $_SESSION["login_id"];

        $sql = "SELECT * FROM Achats JOIN Utilisateurs ON Achats.ach_uti_id = Utilisateurs.uti_id WHERE ach_uti_id = :login_id";

        $query = $this->_connexion->prepare($sql);

        $query->bindValue(':login_id', $user_id, PDO::PARAM_INT); 

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findUserHash()
    {

        if (!isset($_SESSION["login_id"])) {
  
            return null;
        }

        $uti_id = $_SESSION["login_id"];

        $sql = "SELECT uti_cle FROM Utilisateurs WHERE uti_id = :uti_id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':uti_id', $uti_id, PDO::PARAM_INT);

        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function findAchatHash()
    {

        if (!isset($_SESSION["login_id"])) {
  
            return null;
        }

        $uti_id = $_SESSION["login_id"];

        $sql = "SELECT ach_cle FROM Achats WHERE ach_uti_id = :ach_uti_id";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':ach_uti_id', $uti_id, PDO::PARAM_INT);

        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }*/
}
?>    