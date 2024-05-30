<?php

class Inscription extends Controller
{

    public function index()
    {
        $this ->loadModel('Inscription_model');

        $register = $this->Inscription_model->registeraccount();

        $this->render('index', compact('register'));
    }

}
?>