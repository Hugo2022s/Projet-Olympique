<?php

class Connexion extends Controller
{

    public function index()
    {
        $this ->loadModel('Connexion_model');

        $login = $this->Connexion_model->loginaccount();

        $this->render('index', compact('login'));
    }

}
?>