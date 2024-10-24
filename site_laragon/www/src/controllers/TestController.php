<?php

namespace App;

class TestController extends Controller
{

    public function testAction($param1)
    {
  
        echo "Résultat attendu pour testAction avec $param1";
    }
}
