<?php

class Offres extends Controller
{

    public function index()
    {
        $this ->loadModel('Offres_model');

        $offres = $this->Offres_model->getAll();
        $info_off = $this->Offres_model->lire_offres();
        $achat_off = $this->Offres_model->achat_offres();

        $this->render('index', compact('offres','info_off','achat_off'));
    }

}
?>