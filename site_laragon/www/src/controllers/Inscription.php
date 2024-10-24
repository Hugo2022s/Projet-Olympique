<?php

namespace App\Controllers;

class Inscription extends \App\Controller
{

    public function index()
    {
        $this ->loadModel('Inscription_model');

        $register = $this->Inscription_model->registeraccount();

        $this->render('index', compact('register'));
    }

}
?>