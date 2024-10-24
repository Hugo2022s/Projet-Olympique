<?php

class Main extends Controller
{

    public function index()
    {
        // var_dump($_POST);
        // die();
        $this ->loadModel('Mains');

        $this->render('index');
    }

}
?>
