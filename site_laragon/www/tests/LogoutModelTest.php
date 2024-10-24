<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Logout_model;
use PDO;

class LogoutModelTest extends TestCase
{
    protected $logoutModel;
    protected $mockPDO;

    protected function setUp(): void
    {
        $this->mockPDO = $this->createMock(PDO::class);

        $this->logoutModel = new Logout_model($this->mockPDO);
    }

    public function testConstructorAssignsProvidedConnection()
    {
        $reflection = new \ReflectionClass($this->logoutModel);
        $connexionProperty = $reflection->getProperty('_connexion');
        $connexionProperty->setAccessible(true);

        $this->assertSame($this->mockPDO, $connexionProperty->getValue($this->logoutModel));
    }

    public function testConstructorCreatesConnectionIfNoneProvided()
    {
        $model = $this->getMockBuilder(Logout_model::class)
                      ->onlyMethods(['getConnection'])
                      ->getMock();

        $model->expects($this->once())
              ->method('getConnection');

        $model->__construct();
    }
}
?>
