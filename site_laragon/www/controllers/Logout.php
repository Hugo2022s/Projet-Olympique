<?php

class Logout extends Controller
{

    public function index()
    {
        // var_dump($_POST);
        // die();
        $this ->loadModel('Logout_model');

        $this->render('index');
    }

}
?>