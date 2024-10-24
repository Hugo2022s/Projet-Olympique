<?php

class Panier extends Controller
{

    public function index()
    {
        $this ->loadModel('Panier_model');

        $info_panier = $this->Panier_model->findByUser();
        //$user_cle = $this->Panier_model->findUserHash();
        //$achat_cle = $this->Panier_model->findAchatHash();
        //$info_panier['user_cle'] = $user_cle;
        //$info_panier['achat_cle'] = $achat_cle;

        $this->render('index', compact('info_panier'));
    }
    

}
?>
