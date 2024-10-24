<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controller;
use App\TestModel;
use Exception;

class ControllerTest extends TestCase {
    protected const ROOT = __DIR__ . '/../';

    protected function setUp(): void {
        
        if (!defined('ROOT')) {
            define('ROOT', self::ROOT);
        }
    }

    public function testLoadModelSuccessfullyLoadsModel() {
        
        $controller = $this->getMockForAbstractClass(Controller::class);

        $modelName = 'TestModel';

        $modelPath = ROOT . 'src/' . $modelName . '.php';

        if (!file_exists($modelPath)) {
            $this->markTestSkipped("The model file does not exist: $modelPath");
        }

        $controller->loadModel($modelName);

        $this->assertInstanceOf(TestModel::class, $controller->$modelName);
    }

    public function testLoadModelThrowsExceptionWhenModelFileNotFound() {

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Failed to load model');

        $controller = $this->getMockForAbstractClass(Controller::class);

        $controller->loadModel('NonExistentModel');
    }

    public function testRender() {
        $controller = $this->getMockForAbstractClass(Controller::class);

        $data = ['title' => 'Test Title', 'content' => 'Sample Content'];

        ob_start();

        $controller->render('TestView', $data);

        $content = ob_get_clean();

        $this->assertStringContainsString('<h1>Test Title</h1>', $content);
        $this->assertStringContainsString('<p>Sample Content</p>', $content);
    }
}
