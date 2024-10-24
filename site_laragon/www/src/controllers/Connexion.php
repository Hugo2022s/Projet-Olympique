<?php
namespace App\Controllers;

class Connexion extends \App\Controller
{

    public function index()
    {
        $this ->loadModel('Connexion_model');

        $login = $this->Connexion_model->loginaccount();

        $this->render('index', compact('login'));
    }

}
?>