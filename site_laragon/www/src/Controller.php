<?php

namespace App;

use Exception;

abstract class Controller {
    public function loadModel(string $model) {
        $modelPath = ROOT . 'src/' . $model . '.php';
        if (!file_exists($modelPath)) {
            throw new Exception('Failed to load model: ' . $model);
        }
        require_once($modelPath);       
        
        $fullyQualifiedModelName = 'App\\' . $model;
        
        // Instancie le modèle
        $this->$model = new $fullyQualifiedModelName(); 
    }

    public function render(string $fichier, array $data = []) {
        extract($data);
        
        // On démarre le buffer de sortie
        ob_start();

        require_once(ROOT . 'src/TestView.php');

        // On stocke le contenu dans $content
        $content = ob_get_clean();

        // On fabrique le "template"
        require_once(ROOT . 'src/TestLayout.php');
    }
}
?>