<?php

class Main extends Controller
{

    public function index()
    {
        $this ->loadModel('Mains');

        $this->render('index');
    }

}
?>
