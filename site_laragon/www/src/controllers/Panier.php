<?php

namespace App\Controllers;

class Panier extends \App\Controller
{

    public function index()
    {
        $this ->loadModel('Panier_model');

        $info_panier = $this->Panier_model->findByUser();

        $this->render('index', compact('info_panier'));
    }
    

}
?>
