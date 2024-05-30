<?php

class Offres_model extends Model
{
    public function __construct()
    {
        $this->table = "Offres";
        $this->getConnection();
    }

    public function lire_offres()
    {
        $sql = "SELECT * FROM Offres";
        $query = $this->_connexion->prepare($sql);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function achat_offres()
    {
        session_start();

        if (isset($_POST['offre'])) {

         if (isset($_POST['off_cat'], $_POST['off_prix'])) {
            $_SESSION['selected_offer'] = [
                'category' => $_POST['off_cat'],
                'prix' => $_POST['off_prix']
            ];

        $selected_offer = $_SESSION['selected_offer'];
        $category = $selected_offer['category'];
        $prix = $selected_offer['prix'];
        $uti_id = $_SESSION["login_id"];

        // Génère un identifiant unique en utilisant uniqid() et random_bytes()
        $uniqueId = uniqid('', true);
        $randomBytes = random_bytes(16); // Ajustez la longueur selon vos besoins

        // Concatène l'identifiant unique et les octets aléatoires pour créer une valeur unique et aléatoire
        $cle = $uniqueId . bin2hex($randomBytes); // Convertit les octets aléatoires en hexadécimal

        // Hachez la valeur de $firstkey
        $hashedCle = password_hash($cle, PASSWORD_BCRYPT);

        $sql_achat = "INSERT INTO Achats (ach_cat, ach_prix, ach_cle, ach_uti_id) VALUES (:ach_cat, :ach_prix, :ach_cle, :ach_uti_id)";

        $query_achat = $this->_connexion->prepare($sql_achat);

        $query_achat->bindValue(':ach_cat', $category, PDO::PARAM_STR);
        $query_achat->bindValue(':ach_prix', $prix, PDO::PARAM_INT);
        $query_achat->bindValue(':ach_cle', $hashedCle, PDO::PARAM_STR);
        $query_achat->bindValue(':ach_uti_id', $uti_id, PDO::PARAM_INT);

        $query_achat->execute();
    }

    }
}
}
?>    