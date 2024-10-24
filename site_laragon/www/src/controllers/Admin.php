<?php

namespace App\Controllers;

class Admin extends \App\Controller
{
    public function index()
    {
        $this->loadModel('Admin_model');
        
        $admin_login = $this->Admin_model->adminloginaccount();
        
        $this->render('index', compact('admin_login'));
    }
}
?>
