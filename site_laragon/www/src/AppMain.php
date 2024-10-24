<?php

namespace App;

use Exception;

class AppMain
{
    public function run()
    {
        // séparation des params
        $params = explode('/', $_GET['p'] ?? '');

        // est ce qu'un params existe
        if (!empty($params[0])) {
            $controller = ucfirst($params[0]); // TestController
            $action = $params[1] ?? 'index';

            $controllerFile = __DIR__ . '/controllers/' . $controller . '.php';

            if (!file_exists($controllerFile)) {
                throw new Exception("Fichier du contrôleur introuvable:" . $controllerFile);
            }

            require_once($controllerFile);
            
            $controllerClass = "App\\$controller"; 

            if (!class_exists($controllerClass)) {
                throw new Exception("Classe du contrôleur introuvable:" . $controllerClass);
            }

            $controllerInstance = new $controllerClass();

            if (method_exists($controllerInstance, $action)) {
                unset($params[0], $params[1]);
                call_user_func_array([$controllerInstance, $action], $params);
            } else {
                http_response_code(404);
                echo "La page demandée n'existe pas";
            }
        } else {
            require_once(__DIR__ . '/controllers/Main.php');
            $controllerInstance = new Main(); // On instancie le contrôleur
            $controllerInstance->index(); // On appelle la méthode index
        }
    }
}
