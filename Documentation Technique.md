Documentation Technique

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

**Comment changer les informations de connexion**

Le contrôleur et le modèle principaux sont dans le dossier "app".

<?php

abstract class Model{
    // infos bdd
    private $host = "localhost";
    private $db_name = "nom_de_bdd";
    private $username = "nom_utilisateur";
    private $password = "mot_de_passe";

    // propriété contenant la connexion
    protected $_connexion;

    // propriétés contenant les informations de requêtes
    public $table;
    public $id;

    public function getConnection(){
        $this->_connexion = null;

        try{
            $this->_connexion = new PDO('mysql:host='. $this->host . '; dbname=' . $this->db_name, $this->username, $this->password); //on établit la connexion
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

Vous pouvez modifier les informations pour la connexion de l'application dans le fichier Model.php. 

**Comment changer la structure de l'application**

Encore dans le dossier "app", le fichier Controller.php influence la structure de l'application.

<?php

abstract class Controller{
    public function loadModel(string $model){
        require_once(ROOT.'models/'.$model.'.php');
        $this->$model = new $model();
    }

    public function render(string $fichier, array $data = [])
    {
        extract($data);

        // On démarre le buffer de sortie
        ob_start();

        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.php'); //strtolower permet aux url d'être écrit en majuscule ou minuscule

        // On stocke le contenu dans $content
        $content = ob_get_clean();

        // On fabrique le "template"
        require_once(ROOT.'views/layout/default.php');
    }
}

?>

La vérification de l'url commence dans index.php (au tout début du dossier de l'application). Il est important de modifier ce fichier à la fois.

<?php
// constante contenant le chemin vers index.php
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

require_once(ROOT.'app/Model.php');
require_once(ROOT.'app/Controller.php');


// séparation des params
$params = explode('/', $_GET['p']);

// est ce qu'un params existe
if($params[0]!=""){
    $controller = ucfirst($params[0]);


    $action = isset($params[1]) ? $params[1] : 'index';

    require_once(ROOT.'controllers/'.$controller.'.php');

    $controller = new $controller();

    if(method_exists($controller, $action)){
        unset($params[0]);
        unset($params[1]);
        call_user_func_array([$controller, $action], $params);
    }else{
        http_response_code(404);
        echo "La page demandée n'existe pas";
    }
}else{
    require_once(ROOT.'controllers/Main.php');
    // On instancie le contrôleur
    $controller = new Main();

    // On appelle la méthode index
    $controller->index();
}

?>

Le fichier .htaccess lie les fichiers du dossier "app" en envoyant index.php dans l'url.

RewriteEngine On 
RewriteRule ^([a-zA-Z0-9\-\_\/]*)$ index.php?p=$1 //changer le nom du fichier à celui que vous voulez lier

Ainsi, vous pouvez modifier l'url du template, le fonctionnement de la vérification de l'url et la structure de l'application.

**Conventions**

- Chaque modèle à le nom du contrôleur et '_model' à la fin pour son nom (à l'exception de Mains.php)
- Chaque fichier.php principal à l'intérieur d'un sous dossier de "views" est nommé index.php (à l'exception de layout.php)
- Chaque fichier php qui vérifie l'accès à une page s'appel auth_check.php 

**Tests Logiciels**

Les tests logiciels sont disponibles sur la branche "dev". Le dossier "src" contient les fichiers d'applications et leurs tests sont dans le dossier "tests". Le dossier "coverage-html" affiche les résultats des tests réalisés par PHPUnit. Le fichier "phpunit.xml" est essentiel pour réaliser les tests avec PHPUnit.