<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Profil_model;
use PDO;
use PDOStatement;

class ProfilModelTest extends TestCase
{
    protected $profilModel;
    protected $mockPDO;
    protected $mockPDOStatement;

    protected function setUp(): void
    {
        $this->mockPDO = $this->createMock(PDO::class);

        $this->mockPDOStatement = $this->createMock(PDOStatement::class);

        $this->mockPDOStatement->method('execute')->willReturn(true);
        $this->mockPDOStatement->method('fetch')->willReturn([
            'uti_id' => 1,
            'uti_email' => 'mockuser@example.com',
            'uti_nom' => 'Mock User'
        ]);

        $this->mockPDO->method('prepare')->willReturn($this->mockPDOStatement);

        $this->profilModel = new Profil_model($this->mockPDO);
    }

    public function testFindById()
    {
        $_SESSION['login_email'] = 'mockuser@example.com';

        $result = $this->profilModel->findById();

        $expectedResult = [
            'uti_id' => 1,
            'uti_email' => 'mockuser@example.com',
            'uti_nom' => 'Mock User'
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testConstructorCreatesConnectionIfNoneProvided()
    {
        $model = $this->getMockBuilder(Profil_model::class)
                      ->onlyMethods(['getConnection'])
                      ->getMock();

        $model->expects($this->once())
              ->method('getConnection');

        $model->__construct();
    }
}
