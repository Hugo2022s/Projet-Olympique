<?php

namespace App\Controllers;

class Logout extends \App\Controller
{

    public function index()
    {
        $this ->loadModel('Logout_model');

        $this->render('index');
    }

}
?>