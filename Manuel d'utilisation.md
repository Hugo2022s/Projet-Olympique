Manuel d'utilisation

**Comment Ajouter Du Contenu**

- Ajouter un contrôleur dans le dossier "controllers" ie. (Main.php)

Format pour ajouter un contrôleur:

<?php

class Main extends Controller //class doit avoir le nom du contrôleur
{

    public function index()
    {
        $this ->loadModel('Mains'); //'Mains' nom du modèle à lier au contrôleur

        $this->render('index'); //nom de la page php qui composera la vue
    }

}
?>

- Ajouter un modèle dans le dossier "models" ie. (Mains.php)

Format pour ajouter un modèle:

<?php

class Mains extends Model //class doit avoir le nom du modèle
{
    public function __construct() //la fonction __construct() permet d'établir la connection à la bdd
    {                              //ajouter des fonctions au modèle pour avoir des fonctionnalités
        $this->getConnection();
    }
}
?>    

- Créer un dossier dans le dossier "views" qui à le nom de votre contrôleur ie. main
- Dans ce dossier, créer index.php qui a été précedemment inclus dans le contrôleur

**Comment ajouter plusieurs fonctions**

Dans cet exemple le modèle Admin.php utilise une fonction "adminloginaccount" pour établir un système de connexion:

<?php

class Admin extends Controller
{

    public function index()
    {
        $this ->loadModel('Admin_model');

        $admin_login = $this->Admin_model->adminloginaccount(); //la variable $admin_login va contenir toutes les informations de la fonction "adminloginaccount"
                                                                //Le nom du modèle utilisé doit être indiqué dans $this->nom_du_modèle->nom_de_la_fonction
        $this->render('index', compact('admin_login')); //grâce à la fonction php compact, il est possible d'avoir plusieurs fonctions
    }

}
?>
