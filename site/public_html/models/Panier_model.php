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
}
?>    