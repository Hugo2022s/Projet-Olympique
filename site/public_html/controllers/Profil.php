<?php

class Profil extends Controller
{

    public function index()
    {
        $this ->loadModel('Profil_model');

        $profil = $this->Profil_model->getAll();
        $info_uti = $this->Profil_model->findById();

        $this->render('index', compact('profil','info_uti'));
    }

}
?>