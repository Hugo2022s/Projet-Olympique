<?php

namespace Tests;

use App\Controllers\Panier;
use App\Models\Panier_model;
use PHPUnit\Framework\TestCase;

class PanierControllerTest extends TestCase
{
    protected $panierController;
    protected $panierModelMock;

    protected function setUp(): void
    {
        $this->panierModelMock = $this->createMock(Panier_model::class);

        $this->panierController = $this->getMockBuilder(Panier::class)
                                       ->onlyMethods(['loadModel', 'render'])
                                       ->getMock();

        $this->panierController->method('loadModel')->willReturn(null);

        $this->panierController->Panier_model = $this->panierModelMock;
    }

    public function testIndexLoadsModelAndRendersView()
    {
        $mockInfoPanier = [
            ['ach_cle' => 'mock_cle1', 'user_cle' => 'mock_user_cle1'],
            ['ach_cle' => 'mock_cle2', 'user_cle' => 'mock_user_cle2']
        ];

        $this->panierModelMock->method('findByUser')->willReturn($mockInfoPanier);

        $this->panierController->expects($this->once())
            ->method('render')
            ->with('index', ['info_panier' => $mockInfoPanier]);

        $this->panierController->index();
    }
}
