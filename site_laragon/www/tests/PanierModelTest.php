<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Panier_model;
use PDO;
use PDOStatement;

class PanierModelTest extends TestCase
{
    protected $panierModel;
    protected $mockPDO;
    protected $mockPDOStatement;

    protected function setUp(): void
    {
        $this->mockPDO = $this->createMock(PDO::class);

        $this->mockPDOStatement = $this->createMock(PDOStatement::class);

        $this->mockPDOStatement->method('execute')->willReturn(true);
        $this->mockPDOStatement->method('fetchAll')->willReturn([
            ['ach_cle' => 'mock_cle1', 'user_cle' => 'mock_user_cle1'],
            ['ach_cle' => 'mock_cle2', 'user_cle' => 'mock_user_cle2']
        ]);

        $this->mockPDO->method('prepare')->willReturn($this->mockPDOStatement);

        $this->panierModel = new Panier_model($this->mockPDO);
    }

    public function testFindByUser()
    {
        $_SESSION['login_id'] = 1;

        $result = $this->panierModel->findByUser();

        $expectedResult = [
            ['ach_cle' => 'mock_cle1', 'user_cle' => 'mock_user_cle1'],
            ['ach_cle' => 'mock_cle2', 'user_cle' => 'mock_user_cle2']
        ];

        $this->assertEquals($expectedResult, $result);
    }

    public function testConstructorCreatesConnectionIfNoneProvided()
    {
        $model = $this->getMockBuilder(Panier_model::class)
                      ->onlyMethods(['getConnection'])
                      ->getMock();

        $model->expects($this->once())
              ->method('getConnection');

        $model->__construct();
    }
}
