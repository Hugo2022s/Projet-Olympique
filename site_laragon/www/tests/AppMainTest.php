<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\AppMain;
use Exception;

class AppMainTest extends TestCase
{
    // Teste si le contrôleur et l'action sont chargés correctement
    public function testLoadControllerAndAction()
    {
        $_GET['p'] = 'TestController/testAction/param1';

        $app = new AppMain();

        ob_start(); 
        $app->run();
        $output = ob_get_clean(); 

        $this->assertStringContainsString('Résultat attendu pour testAction avec param1', $output);
    }

    // Teste le contrôleur principal (MainController)
    public function testLoadDefaultController()
    {
        unset($_GET['p']);

        $app = new AppMain();

        ob_start(); 
        $app->run();
        $output = ob_get_clean(); 

        $this->assertStringContainsString('Résultat attendu pour la méthode index du contrôleur principal', $output);
    }

    // Vérifie l'exception quand le fichier du contrôleur n'existe pas
    public function testControllerFileNotFound()
    {
        $_GET['p'] = 'NonExistentController/index';

        $app = new AppMain();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Fichier du contrôleur introuvable:');

        ob_start(); 
        try {
            $app->run(); 
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
        ob_end_clean();
    }

    // Vérifie l'exception quand il n'y a aucune action
    public function testActionNotFound()
    {
        $_GET['p'] = 'TestController/nonExistentAction';

        $app = new AppMain();

        ob_start(); 
        $app->run();
        $output = ob_get_clean(); 

        $this->assertStringContainsString('La page demandée n\'existe pas', $output);
    }

    public function testControllerClassNotFound()
    {
        $_GET['p'] = 'InvalidController/testAction';

        $app = new AppMain();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Classe du contrôleur introuvable:App\InvalidController');

        ob_start();
        try {
            $app->run();
        } catch (Exception $e) {
            ob_end_clean();
            throw $e;
        }
        ob_end_clean();
    }

    protected function tearDown(): void
    {
    }
}
