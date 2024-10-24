<?php

class Logout extends Controller
{

    public function index()
    {
        $this ->loadModel('Logout_model');

        $this->render('index');
    }

}
?>