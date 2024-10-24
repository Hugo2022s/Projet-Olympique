<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\Config;
use App\Models\Config_model;

class ConfigControllerTest extends TestCase
{
    protected $configController;
    protected $configModelMock;

    protected function setUp(): void
    {
        if (!defined('ROOT')) {
            define('ROOT', dirname(__DIR__) . '/');
        }

        // Mock de la classe Config_model
        $this->configModelMock = $this->createMock(Config_model::class);

        $this->configController = $this->getMockBuilder(Config::class)
                                      ->onlyMethods(['loadModel', 'render'])
                                      ->getMock();

        $this->configController->method('loadModel')->willReturn($this->configModelMock);

        $this->configController->method('render')->willReturn('index output');

        $this->configController->Config_model = $this->configModelMock;
    }

    public function testIndexMethod()
    {
        // Configure les attentes pour les méthodes du modèle
        $this->configModelMock->expects($this->once())
            ->method('getAll')
            ->willReturn(['profile_data']);

        $this->configModelMock->expects($this->once())
            ->method('findById')
            ->willReturn(['admin_email' => 'admin@example.com']);

        $this->configModelMock->expects($this->once())
            ->method('lire_offres')
            ->willReturn(['offer_data']);

        $this->configModelMock->expects($this->once())
            ->method('getAllCategories')
            ->willReturn(['category_data']);

        // Simule des méthodes qui n'ont peut-être pas besoin de comportement réel
        $this->configModelMock->expects($this->once())
            ->method('add')
            ->willReturn(null);

        $this->configModelMock->expects($this->once())
            ->method('delete')
            ->willReturn(null);

        $this->configModelMock->expects($this->once())
            ->method('modify')
            ->willReturn(null);

        $this->configModelMock->expects($this->once())
            ->method('countAchatCategories')
            ->willReturn(['category_count_data']);

        $this->configController->index();

        $output = $this->configController->render('index');

        $this->assertStringContainsString('index output', $output);
    }
}
