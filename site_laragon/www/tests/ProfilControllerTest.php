<?php

namespace Tests;

use App\Controllers\Profil;
use App\Models\Profil_model;
use PHPUnit\Framework\TestCase;

class ProfilControllerTest extends TestCase
{
    protected $profilController;
    protected $profilModelMock;

    protected function setUp(): void
    {
        $this->profilModelMock = $this->createMock(Profil_model::class);

        $this->profilController = $this->getMockBuilder(Profil::class)
                                       ->onlyMethods(['loadModel', 'render'])
                                       ->getMock();

        $this->profilController->method('loadModel')->willReturn(null);

        $this->profilController->Profil_model = $this->profilModelMock;
    }

    public function testIndexLoadsModelAndRendersView()
    {
        $mockProfil = [
            ['uti_id' => 1, 'uti_email' => 'mockuser@example.com', 'uti_nom' => 'Mock User'],
            ['uti_id' => 2, 'uti_email' => 'mockuser2@example.com', 'uti_nom' => 'Mock User 2']
        ];
        $mockInfoUti = ['uti_id' => 1, 'uti_email' => 'mockuser@example.com', 'uti_nom' => 'Mock User'];

        $this->profilModelMock->method('getAll')->willReturn($mockProfil);
        $this->profilModelMock->method('findById')->willReturn($mockInfoUti);

        $this->profilController->expects($this->once())
            ->method('render')
            ->with('index', ['profil' => $mockProfil, 'info_uti' => $mockInfoUti]);

        $this->profilController->index();
    }
}
