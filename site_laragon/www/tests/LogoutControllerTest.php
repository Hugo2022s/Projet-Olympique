<?php

namespace Tests;

use App\Controllers\Logout;
use App\Models\Logout_model;
use PHPUnit\Framework\TestCase;

class LogoutControllerTest extends TestCase
{
    protected $logoutController;
    protected $logoutModelMock;

    protected function setUp(): void
    {
        $this->logoutModelMock = $this->createMock(Logout_model::class);

        $this->logoutController = $this->getMockBuilder(Logout::class)
                                      ->onlyMethods(['loadModel', 'render'])
                                      ->getMock();

        $this->logoutController->method('loadModel')->willReturn($this->logoutModelMock);
    }

    public function testIndexLoadsModelAndRendersView()
    {
        $this->logoutController->expects($this->once())
            ->method('loadModel')
            ->with('Logout_model');

        $this->logoutController->expects($this->once())
            ->method('render')
            ->with('index');

        $this->logoutController->index();
    }
}
?>
