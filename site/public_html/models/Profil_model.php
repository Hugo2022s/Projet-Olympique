<?php

class Profil_model extends Model
{
    public function __construct()
    {
        $this->table = "Utilisateurs";
        $this->getConnection();
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