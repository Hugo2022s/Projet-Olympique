<?php

namespace App\Models;

use PDO;

class Config_model extends \App\Model
{
    public function __construct()
    {
        $this->table = "Admins";
        $this->getConnection();
    }

    public function findById()
    {
        session_start();
        $checkemail = $_SESSION["admin_email"];

        $sql = "SELECT * FROM Admins WHERE ad_email = :admin_email";
        $query = $this->_connexion->prepare($sql);
        $query->bindValue(':admin_email', $checkemail, PDO::PARAM_STR); 

        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function lire_offres()
    {
        $sql = "SELECT * FROM Offres";
        $query = $this->_connexion->prepare($sql);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllCategories()
    {
        $sql = "SELECT DISTINCT off_cat FROM Offres";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add()
    {
        if (isset($_POST["offSubmit"])) {
            // on vérifie que les champs ne sont pas vide
            if (!empty($_POST["off_cat"]) && !empty($_POST["off_prix"]) && !empty($_POST["off_descrip"])) {
    
                $off_cat = $_POST["off_cat"];
                $off_prix = $_POST["off_prix"];
                $off_descrip = $_POST["off_descrip"];
    
                $req = "INSERT INTO Offres (off_cat, off_prix, off_descrip) VALUES (:off_cat, :off_prix, :off_descrip)";
    
                // vérifie si la préparation de la requête est réussie
                $RequestStatement = $this->_connexion->prepare($req);
                if ($RequestStatement) {
                    $RequestStatement->bindValue(':off_cat', $off_cat, PDO::PARAM_STR);
                    $RequestStatement->bindValue(':off_prix', $off_prix, PDO::PARAM_INT);
                    $RequestStatement->bindValue(':off_descrip', $off_descrip, PDO::PARAM_STR);
    
                    $RequestStatement->execute();
                    
                    // on vérifie si le statement =/ false
                    if ($RequestStatement->errorCode() == '00000') {
                        echo "Réussite de l'insertion ";
                        echo "l'offre " . $off_cat . " a bien été ajouté. ";
                    } else {
                        echo "Erreur N°" . $RequestStatement->errorCode() . " lors de l'insertion.";
                    }
                } else {
                    echo "Erreur dans le format de la requête"; // Prepare failed
                }
            }
        }
    }
    
    
    public function delete()
    {
        if (isset($_POST["offDelete"]) && isset($_POST["off_cat"])) {
            $category = $_POST["off_cat"];
    
            $efface = "DELETE FROM Offres WHERE off_cat = :off_cat";
            $stmt = $this->_connexion->prepare($efface);
    
            // vérifie si prepare a réussi
            if ($stmt) {
                $stmt->bindParam(':off_cat', $category, PDO::PARAM_STR);
                $stmt->execute();
    
                if ($stmt->errorCode() == '00000') {
                    echo "Réussite de la suppression";
                    echo " l'offre " . $category . " a bien été supprimée";
                } else {
                    echo "Erreur N°" . $stmt->errorCode() . " lors de la suppression";
                }
            } else {
                echo "Erreur dans le format de requête";
            }
        }
    }
    

    public function modify()
    {
        if (isset($_POST["offModif"])) {
            if (!empty($_POST["off_cat"]) && !empty($_POST["off_prix"]) && !empty($_POST["off_descrip"])) {
                $off_cat = $_POST["off_cat"];
                $off_prix = $_POST["off_prix"];
                $off_descrip = $_POST["off_descrip"];
    
                $req = "UPDATE Offres SET off_cat = :off_cat, off_prix = :off_prix, off_descrip = :off_descrip WHERE off_cat = :off_cat";
                $requete = $this->_connexion->prepare($req);
    
                // vérifie si prepare a réussi
                if ($requete) {
                    $requete->bindValue(':off_cat', $off_cat, PDO::PARAM_STR);
                    $requete->bindValue(':off_prix', $off_prix, PDO::PARAM_INT);
                    $requete->bindValue(':off_descrip', $off_descrip, PDO::PARAM_STR);
                    $requete->execute();
    
                    if ($requete->errorCode() == '00000') {
                        echo "Réussite de la modification ";
                        echo "de la catégorie " . $off_cat . " a bien été modifiée.";
                    } else {
                        echo "Erreur N°" . $requete->errorCode() . " lors de la modification.";
                    }
                } else {
                    echo "Erreur dans le format de la requête";
                }
            }
        }
    }
    
public function countAchatCategories()
{
    $sql = "SELECT ach_cat, COUNT(*) AS category_count 
            FROM Achats 
            GROUP BY ach_cat";
    $query = $this->_connexion->prepare($sql);

    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
}
?>    