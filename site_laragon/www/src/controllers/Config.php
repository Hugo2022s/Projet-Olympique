<?php

namespace App\Controllers;

class Config extends \App\Controller
{

    public function index()
    {
        $this ->loadModel('Config_model');

        $profil = $this->Config_model->getAll();
        $info_ad = $this->Config_model->findById();
        $info_off = $this->Config_model->lire_offres(); 
        $lire_off = $this->Config_model->getAllCategories();    
        $add_off = $this->Config_model->add();
        $delete_off = $this->Config_model->delete();
        $modify_off = $this->Config_model->modify();
        $config_ach = $this->Config_model->countAchatCategories();

        $this->render('index', compact('profil','info_ad','info_off','lire_off','add_off','delete_off','modify_off','config_ach'));
    }

}
?>