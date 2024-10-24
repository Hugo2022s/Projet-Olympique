<?php

namespace Tests;

use App\Controllers\Offres;
use App\Models\Offres_model;
use PHPUnit\Framework\TestCase;

class OffresControllerTest extends TestCase
{
    protected $offresController;
    protected $offresModelMock;

    protected function setUp(): void
    {
        $this->offresModelMock = $this->createMock(Offres_model::class);

        $this->offresController = $this->getMockBuilder(Offres::class)
                                       ->onlyMethods(['loadModel', 'render'])
                                       ->getMock();

        $this->offresController->method('loadModel')->willReturn(null);

        $this->offresController->Offres_model = $this->offresModelMock;
    }

    public function testIndexLoadsModelAndRendersView()
    {
    
        $mockOffres = ['offre1', 'offre2'];
        $mockInfoOff = ['info1', 'info2'];
        $mockAchatOff = ['achat1', 'achat2'];

        $this->offresModelMock->method('getAll')->willReturn($mockOffres);
        $this->offresModelMock->method('lire_offres')->willReturn($mockInfoOff);
        $this->offresModelMock->method('achat_offres')->willReturn($mockAchatOff);

        $this->offresController->expects($this->once())
            ->method('render')
            ->with('index', [
                'offres' => $mockOffres,
                'info_off' => $mockInfoOff,
                'achat_off' => $mockAchatOff
            ]);

        $this->offresController->index();
    }
}
