<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Admin_model;
use PDO;
use PDOStatement;

class AdminModelTest extends TestCase
{
    protected $adminModel;
    protected $mockPDO;

    protected function setUp(): void
    {
        // Un mock d'une instance PDO est créée
        $this->mockPDO = $this->createMock(PDO::class);

        // Instancie Admin_model avec le mock de l'instance PDO
        $this->adminModel = new Admin_model($this->mockPDO);
    }

    public function testAdminLoginAccountSuccess()
    {
        // Simulation d'un login réussi
        $_POST['admin_login'] = true;
        $_POST['admin_email'] = 'admin@example.com';
        $_POST['admin_password'] = 'password123';

        $mockStatement = $this->createMock(PDOStatement::class);
        $mockStatement->method('fetch')->willReturn(['ad_mdp' => password_hash('password123', PASSWORD_DEFAULT)]);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

    $result = $this->adminModel->adminloginaccount();

    $this->assertEquals('Vous avez logged in!', $result);
    }

    public function testAdminLoginAccountFailure()
    {
        // Simulation d'un login échoué
        $_POST['admin_login'] = true;
        $_POST['admin_email'] = 'admin@example.com';
        $_POST['admin_password'] = 'wrongpassword';

        $mockStatement = $this->createMock(PDOStatement::class);
        $mockStatement->method('fetch')->willReturn(['ad_mdp' => password_hash('correctpassword', PASSWORD_DEFAULT)]);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

    $result = $this->adminModel->adminloginaccount();

    $this->assertEquals('Vérifiez vos ajouts!', $result);
    }

    public function testConstructorCreatesConnectionIfNoneProvided()
    {
        // Vérifie si le constructeur créé une connection si il n'y en a pas
        $model = $this->getMockBuilder(Admin_model::class)
                      ->onlyMethods(['getConnection'])
                      ->getMock();

        $model->expects($this->once())
              ->method('getConnection');

        $model->__construct();
    }

    public function testNoActionPerformed()
    {
        // Simule $_POST vide
        $_POST = [];

        $result = $this->adminModel->adminloginaccount();

        $this->assertEquals("Aucune action n'a été effectuée.", $result);
    }
}

