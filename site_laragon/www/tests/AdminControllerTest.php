<?php

namespace Tests;

use App\Controllers\Admin;
use App\Models\Admin_model;
use PHPUnit\Framework\TestCase;

class AdminControllerTest extends TestCase
{
    protected $adminController;
    protected $adminModelMock;

    protected function setUp(): void
    {
        // Mock de la classe Admin_model
        $this->adminModelMock = $this->createMock(Admin_model::class);

        $this->adminController = $this->getMockBuilder(Admin::class)
                                      ->onlyMethods(['loadModel', 'render'])
                                      ->getMock();

        $this->adminController->method('loadModel')->willReturn($this->adminModelMock);
        
        $this->adminController->Admin_model = $this->adminModelMock;
    }

    public function testIndexMethodWithSuccessfulLogin()
    {
        // Simule un login réussi
        $admin_login = ['email' => 'admin@example.com'];
        $this->adminModelMock
            ->method('adminloginaccount')
            ->willReturn($admin_login);

        $this->adminController->expects($this->once())
            ->method('render')
            ->with('index', ['admin_login' => $admin_login]);

        $this->adminController->index();
    }

    public function testIndexMethodWithFailedLogin()
    {
        // Simule un login échoué
        $this->adminModelMock
            ->method('adminloginaccount')
            ->willReturn(null);

        $this->adminController->expects($this->once())
            ->method('render')
            ->with('index', ['admin_login' => null]);

        $this->adminController->index();
    }
}
?>
