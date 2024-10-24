<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Inscription;
use App\Models\Inscription_model;
use PDO;

class InscriptionControllerTest extends TestCase
{
    protected $inscriptionController;
    protected $inscriptionModelMock;

    protected function setUp(): void
    {
        $mockPDO = $this->createMock(PDO::class);
        $this->inscriptionModelMock = $this->getMockBuilder(Inscription_model::class)
                                           ->setConstructorArgs([$mockPDO])
                                           ->getMock();

        $this->inscriptionController = $this->getMockBuilder(Inscription::class)
            ->onlyMethods(['loadModel', 'render'])
            ->getMock();

        $this->inscriptionController->method('loadModel')->willReturn($this->inscriptionModelMock);
        
        $this->inscriptionController->Inscription_model = $this->inscriptionModelMock;
    }

    public function testIndexMethodWithSuccessfulRegistration()
    {
        $register = "Vous avez été enregistré!";
        $this->inscriptionModelMock
            ->method('registeraccount')
            ->willReturn($register);

        $this->inscriptionController->expects($this->once())
            ->method('render')
            ->with('index', ['register' => $register]);

        $this->inscriptionController->index();
    }

    public function testIndexMethodWithFailedRegistration()
    {
        $register = "Erreur : Un utilisateur avec cet email existe déjà.";
        $this->inscriptionModelMock
            ->method('registeraccount')
            ->willReturn($register);

        $this->inscriptionController->expects($this->once())
            ->method('render')
            ->with('index', ['register' => $register]);

        $this->inscriptionController->index();
    }
}
