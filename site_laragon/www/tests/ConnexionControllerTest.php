<?php

namespace Tests;

use App\Controllers\Connexion; 
use App\Models\Connexion_model;
use PHPUnit\Framework\TestCase;

class ConnexionControllerTest extends TestCase
{
    protected $connexionController;
    protected $connexionModelMock;

    protected function setUp(): void
    {
        // Mock de la classe Connexion_model
        $this->connexionModelMock = $this->createMock(Connexion_model::class);

        $this->connexionController = $this->getMockBuilder(Connexion::class)
            ->onlyMethods(['loadModel', 'render'])
            ->getMock();

        $this->connexionController->method('loadModel')->willReturn($this->connexionModelMock);
        
        $this->connexionController->Connexion_model = $this->connexionModelMock;
    }

    public function testIndexMethodWithSuccessfulLogin()
    {
        // Simulation d'un login réussi
        $loginMessage = 'Vous avez logged in!';
        $this->connexionModelMock
            ->method('loginaccount')
            ->willReturn($loginMessage);

        $this->connexionController->expects($this->once())
            ->method('render')
            ->with('index', ['login' => $loginMessage]);

        $this->connexionController->index();
    }

    public function testIndexMethodWithFailedLogin()
    {
        // Simulation d'un login échoué
        $failedLoginMessage = 'Vérifiez vos ajouts!';
        $this->connexionModelMock
            ->method('loginaccount')
            ->willReturn($failedLoginMessage);

        $this->connexionController->expects($this->once())
            ->method('render')
            ->with('index', ['login' => $failedLoginMessage]);

        $this->connexionController->index();
    }

    public function testIndexMethodWithNoAction()
    {
        // Simule $_POST vide
        $noActionMessage = 'No action performed.';
        $_POST = [];

        $this->connexionModelMock
            ->method('loginaccount')
            ->willReturn($noActionMessage);

        $this->connexionController->expects($this->once())
            ->method('render')
            ->with('index', ['login' => $noActionMessage]);

        $this->connexionController->index();
    }
}
