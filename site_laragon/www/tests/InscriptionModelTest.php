<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Inscription_model;
use PDO;
use PDOStatement;

class InscriptionModelTest extends TestCase
{
    protected $inscriptionModel;
    protected $mockPDO;

    protected function setUp(): void
    {
        $this->mockPDO = $this->createMock(PDO::class);

        $this->inscriptionModel = new Inscription_model($this->mockPDO);
    }

    public function testRegisterAccountSuccess()
    {
        $_POST['register'] = true;
        $_POST['name_register'] = 'John';
        $_POST['surname_register'] = 'Doe';
        $_POST['email_register'] = 'johndoe@example.com';
        $_POST['password_register'] = 'password123';
        $_POST['cPassword_register'] = 'password123';

        $mockStatement = $this->createMock(PDOStatement::class);
        $mockStatement->method('fetchColumn')->willReturn(0);
        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals('Vous avez été enregistré!', $result);
    }

    public function testRegisterAccountEmptyFields()
    {
        $_POST['register'] = true;
        $_POST['name_register'] = '';
        $_POST['surname_register'] = '';
        $_POST['email_register'] = '';
        $_POST['password_register'] = '';
        $_POST['cPassword_register'] = '';

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals("Tous les champs doivent être remplis!", $result);
    }

    public function testRegisterAccountInvalidEmail()
    {
        $_POST['register'] = true;
        $_POST['name_register'] = 'John';
        $_POST['surname_register'] = 'Doe';
        $_POST['email_register'] = 'invalid-email';
        $_POST['password_register'] = 'password123';
        $_POST['cPassword_register'] = 'password123';

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals("L'adresse e-mail n'est pas valide!", $result);
    }

    public function testRegisterAccountPasswordMismatch()
    {
        $_POST['register'] = true;
        $_POST['name_register'] = 'John';
        $_POST['surname_register'] = 'Doe';
        $_POST['email_register'] = 'johndoe@example.com';
        $_POST['password_register'] = 'password123';
        $_POST['cPassword_register'] = 'password456';

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals("Veuillez vérifier vos mots de passe!", $result);
    }

    public function testRegisterAccountUsernameAlreadyExists()
    {
        $_POST['register'] = true;
        $_POST['name_register'] = 'John';
        $_POST['surname_register'] = 'Doe';
        $_POST['email_register'] = 'johndoe@example.com';
        $_POST['password_register'] = 'password123';
        $_POST['cPassword_register'] = 'password123';

        $mockStatement = $this->createMock(PDOStatement::class);
        $mockStatement->method('fetchColumn')->willReturnOnConsecutiveCalls(1, 0, 0);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals("Erreur : Un utilisateur avec ce nom existe déjà.", $result);
    }

    public function testRegisterAccountSurnameAlreadyExists()
    {
        $_POST['register'] = true;
        $_POST['name_register'] = 'John';
        $_POST['surname_register'] = 'Doe';
        $_POST['email_register'] = 'johndoe@example.com';
        $_POST['password_register'] = 'password123';
        $_POST['cPassword_register'] = 'password123';

        $mockStatement = $this->createMock(PDOStatement::class);
        $mockStatement->method('fetchColumn')->willReturnOnConsecutiveCalls(0, 1, 0);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals("Erreur : Un utilisateur avec ce prénom existe déjà.", $result);
    }

    public function testRegisterAccountEmailAlreadyExists()
    {
        $_POST['register'] = true;
        $_POST['name_register'] = 'John';
        $_POST['surname_register'] = 'Doe';
        $_POST['email_register'] = 'johndoe@example.com';
        $_POST['password_register'] = 'password123';
        $_POST['cPassword_register'] = 'password123';

        $mockStatement = $this->createMock(PDOStatement::class);

        $mockStatement->method('fetchColumn')
                      ->willReturnOnConsecutiveCalls(0, 0, 1);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals("Erreur : Un utilisateur avec cet email existe déjà.", $result);
    }

    public function testNoActionPerformed()
    {
        $_POST = [];

        $result = $this->inscriptionModel->registeraccount();

        $this->assertEquals("Aucune action n'a été effectuée.", $result);
    }

    public function testConstructorCreatesConnectionIfNoneProvided()
    {
        $model = $this->getMockBuilder(Inscription_model::class)
                      ->onlyMethods(['getConnection'])
                      ->getMock();

        $model->expects($this->once())
              ->method('getConnection');

        $model->__construct();
    }
}
