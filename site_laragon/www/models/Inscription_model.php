<?php

class Inscription_model extends Model
{
    public function __construct()
    {
        $this->getConnection();
    }

    public function registeraccount()
    {
        if (isset($_POST['register'])) {
    
            $nom = $_POST['name_register'];
            $prenom = $_POST['surname_register'];
            $email = $_POST['email_register'];
            $password = $_POST['password_register'];
            $cPassword = $_POST['cPassword_register'];
    
            // Validation de base pour le nom, le prénom, l'e-mail et le nom d'utilisateur
            if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($cPassword)) {
                echo "Tous les champs doivent être remplis!";
                return;
            }
    
            // Validation du format d'email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "L'adresse e-mail n'est pas valide!";
                return;
            }
    
            // Validation de la correspondance du mot de passe
            if ($password != $cPassword) {
                echo "Veuillez vérifier vos mots de passe!";
                return;
            }

            // Vérifie si le nom d'utilisateur existe déjà
            $checkUsernameSql = "SELECT COUNT(*) FROM Utilisateurs WHERE uti_nom = :uti_nom";
            $checkUsernameStmt = $this->_connexion->prepare($checkUsernameSql);
            $checkUsernameStmt->bindValue(':uti_nom', $nom, PDO::PARAM_STR);
            $checkUsernameStmt->execute();
            $usernameCount = $checkUsernameStmt->fetchColumn();
    
            if ($usernameCount > 0) {
                echo "Erreur : Un utilisateur avec ce nom existe déjà.";
                return;
            }
    
            // Vérifie si le prénom existe déjà
            $checkSurnameSql = "SELECT COUNT(*) FROM Utilisateurs WHERE uti_prenom = :uti_prenom";
            $checkSurnameStmt = $this->_connexion->prepare($checkSurnameSql);
            $checkSurnameStmt->bindValue(':uti_prenom', $prenom, PDO::PARAM_STR);
            $checkSurnameStmt->execute();
            $surnameCount = $checkSurnameStmt->fetchColumn();
     
            if ($surnameCount > 0) {
                echo "Erreur : Un utilisateur avec ce prénom existe déjà.";
                return;
            }

            // Vérifiez si l'email existe déjà
            $checkEmailSql = "SELECT COUNT(*) FROM Utilisateurs WHERE uti_email = :uti_email";
            $checkEmailStmt = $this->_connexion->prepare($checkEmailSql);
            $checkEmailStmt->bindValue(':uti_email', $email, PDO::PARAM_STR);
            $checkEmailStmt->execute();
            $emailCount = $checkEmailStmt->fetchColumn();
    
            if ($emailCount > 0) {
                echo "Erreur : Un utilisateur avec cet email existe déjà.";
                return;
            }

            // Hachage du mot de passe
            $hash = password_hash($password, PASSWORD_BCRYPT);

            // Génère un identifiant unique en utilisant uniqid() et random_bytes()
            $uniqueId = uniqid('', true);
            $randomBytes = random_bytes(16); // Ajustez la longueur selon vos besoins

            // Concatène l'identifiant unique et les octets aléatoires pour créer une valeur unique et aléatoire
            $firstkey = $uniqueId . bin2hex($randomBytes); // Convertit les octets aléatoires en hexadécimal

            // Hachez la valeur de $firstkey
            $hashedKey = password_hash($firstkey, PASSWORD_BCRYPT);
            
            $req = "INSERT INTO Utilisateurs (uti_nom, uti_prenom, uti_mdp, uti_email, uti_cle) VALUES (:uti_nom, :uti_prenom, :uti_mdp, :uti_email, :uti_cle)";
            $RequestStatement = $this->_connexion->prepare($req);
    
            $RequestStatement->bindValue(':uti_nom', $nom, PDO::PARAM_STR);
            $RequestStatement->bindValue(':uti_prenom', $prenom, PDO::PARAM_STR);
            $RequestStatement->bindValue(':uti_mdp', $hash, PDO::PARAM_STR);
            $RequestStatement->bindValue(':uti_email', $email, PDO::PARAM_STR);
            $RequestStatement->bindValue(':uti_cle', $hashedKey, PDO::PARAM_STR);
    
            $RequestStatement->execute();
    
            echo "Vous avez été enregistré!";
        }
    }
}
?>