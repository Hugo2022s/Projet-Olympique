<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Connexion_model;
use PDO;
use PDOStatement;

class ConnexionModelTest extends TestCase
{
    protected $connexionModel;
    protected $mockPDO;

    protected function setUp(): void
    {
        // Un mock d'une instance PDO est créée
        $this->mockPDO = $this->createMock(PDO::class);

        // Instancie Admin_model avec le mock de l'instance PDO
        $this->connexionModel = new Connexion_model($this->mockPDO);
    }

    public function testLoginAccountSuccess()
    {
        // Simulation d'un login réussi
        $_POST['login'] = true;
        $_POST['login_email'] = 'user@example.com';
        $_POST['login_password'] = 'password123';

        $mockStatement = $this->createMock(PDOStatement::class);
        $mockStatement->method('fetch')->willReturn(['uti_mdp' => password_hash('password123', PASSWORD_DEFAULT)]);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->connexionModel->loginaccount();

        $this->assertEquals('Vous avez logged in!', $result);
    }

    public function testLoginAccountFailure()
    {
        // Simulation d'un login échoué
        $_POST['login'] = true;
        $_POST['login_email'] = 'user@example.com';
        $_POST['login_password'] = 'wrongpassword';

        $mockStatement = $this->createMock(PDOStatement::class);
        $mockStatement->method('fetch')->willReturn(['uti_mdp' => password_hash('correctpassword', PASSWORD_DEFAULT)]);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->connexionModel->loginaccount();

        $this->assertEquals('Vérifiez vos ajouts!', $result);
    }

    public function testNoActionPerformed()
    {
        // Simule $_POST vide
        $_POST = [];

        $result = $this->connexionModel->loginaccount();

        $this->assertEquals("Aucune action n'a été effectuée.", $result);
    }

    public function testConstructorCreatesConnectionIfNoneProvided()
    {
        // Vérifie si le constructeur créé une connection si il n'y en a pas
        $model = $this->getMockBuilder(Connexion_model::class)
                      ->onlyMethods(['getConnection'])
                      ->getMock();

        $model->expects($this->once())
              ->method('getConnection');

        $model->__construct();
    }
}
