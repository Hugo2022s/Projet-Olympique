<?php

namespace Tests;

use App\Models\Offres_model;
use PHPUnit\Framework\TestCase;
use PDO;
use PDOStatement;

class OffresModelTest extends TestCase
{
    protected $offresModel;
    protected $mockPDO;
    protected $mockPDOStatement;

    protected function setUp(): void
    {
        $this->mockPDO = $this->createMock(PDO::class);
        $this->mockPDOStatement = $this->createMock(PDOStatement::class);

        $this->offresModel = new Offres_model($this->mockPDO);
    }

    public function testLireOffres()
    {
        $this->mockPDOStatement->method('fetchAll')->willReturn([
            ['offre' => 'Offre1'], ['offre' => 'Offre2']
        ]);

        $this->mockPDO->method('prepare')->willReturn($this->mockPDOStatement);

        $result = $this->offresModel->lire_offres();

        $this->assertSame([['offre' => 'Offre1'], ['offre' => 'Offre2']], $result);
    }

    public function testAchatOffresInsertsOffer()
    {
        $_SESSION['login_id'] = 1;
        $_POST['offre'] = true;
        $_POST['off_cat'] = 'Category1';
        $_POST['off_prix'] = 100;

        $this->mockPDO->method('prepare')->willReturn($this->mockPDOStatement);
        $this->mockPDOStatement->expects($this->once())->method('execute');

        $this->offresModel->achat_offres();

        $this->assertSame([
            'category' => 'Category1',
            'prix' => 100
        ], $_SESSION['selected_offer']);
    }

    public function testConstructorCreatesConnectionIfNoneProvided()
    {
        $model = $this->getMockBuilder(Offres_model::class)
                      ->onlyMethods(['getConnection'])
                      ->getMock();

        $model->expects($this->once())
              ->method('getConnection');

        $model->__construct();
    }
}
