<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Config_model;
use PDO;

class ConfigModelTest extends TestCase
{
    protected $configModel;
    protected $mockPDO;

    protected function setUp(): void
    {
        // Un mock d'une instance PDO est créée
        $this->mockPDO = $this->createMock(PDO::class);

        // Instancie Admin_model avec le mock de l'instance PDO
        $this->configModel = new Config_model();

        $reflection = new \ReflectionClass($this->configModel);
        $property = $reflection->getProperty('_connexion');
        $property->setAccessible(true);
        $property->setValue($this->configModel, $this->mockPDO);
    }

    public function testFindById()
    {
        // Simule les données de session
        $_SESSION['admin_email'] = 'admin@example.com';

        $mockStatement = $this->createMock(\PDOStatement::class);
        $mockStatement->method('fetch')->willReturn(['ad_email' => 'admin@example.com']);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->configModel->findById();
        $this->assertEquals('admin@example.com', $result['ad_email']);
    }

    public function testLireOffres()
    {
        // Simule le PDOStatement
        $mockStatement = $this->createMock(\PDOStatement::class);
        $mockStatement->method('fetchAll')->willReturn([['offer1'], ['offer2']]);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->configModel->lire_offres();
        $this->assertCount(2, $result);
    }

    public function testGetAllCategories()
    {
        // Simule le PDOStatement
        $mockStatement = $this->createMock(\PDOStatement::class);
        $mockStatement->method('fetchAll')->willReturn([['category1'], ['category2']]);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->configModel->getAllCategories();
        $this->assertCount(2, $result);
    }

    public function testAdd()
    {
        $_POST['offSubmit'] = true;
        $_POST['off_cat'] = 'Test Category';
        $_POST['off_prix'] = 100;
        $_POST['off_descrip'] = 'Test Description';

        $mockStatement = $this->createMock(\PDOStatement::class);
        $mockStatement->method('execute')->willReturn(true);
        $mockStatement->method('errorCode')->willReturn('00000');

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        ob_start();
        $this->configModel->add();
        $output = ob_get_clean();

        $this->assertStringContainsString('Réussite de l\'insertion', $output);
    }

    public function testDelete()
    {
        $_POST['offDelete'] = true;
        $_POST['off_cat'] = 'Test Category';

        $mockStatement = $this->createMock(\PDOStatement::class);
        $mockStatement->method('execute')->willReturn(true);
        $mockStatement->method('errorCode')->willReturn('00000');

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        ob_start();
        $this->configModel->delete();
        $output = ob_get_clean();

        $this->assertStringContainsString('Réussite de la suppression', $output);
    }

    public function testModify()
    {
        $_POST['offModif'] = true;
        $_POST['off_cat'] = 'Updated Category';
        $_POST['off_prix'] = 150;
        $_POST['off_descrip'] = 'Updated Description';

        $mockStatement = $this->createMock(\PDOStatement::class);
        $mockStatement->method('execute')->willReturn(true);
        $mockStatement->method('errorCode')->willReturn('00000');

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        ob_start();
        $this->configModel->modify();
        $output = ob_get_clean();

        $this->assertStringContainsString('Réussite de la modification', $output);
    }

    public function testCountAchatCategories()
    {
        // Simule le PDOStatement
        $mockStatement = $this->createMock(\PDOStatement::class);
        $mockStatement->method('fetchAll')->willReturn([['ach_cat' => 'category1', 'category_count' => 5]]);

        $this->mockPDO->method('prepare')->willReturn($mockStatement);

        $result = $this->configModel->countAchatCategories();
        $this->assertCount(1, $result);
        $this->assertEquals('category1', $result[0]['ach_cat']);
        $this->assertEquals(5, $result[0]['category_count']);
    }

    public function testAddInvalidDataInput()
    {
        // Simule des informations POST
        $_POST = [
            'offSubmit' => true,
            'off_cat' => 'Category Test',
            'off_prix' => 100,
            'off_descrip' => 'Description test'
        ];
    
        $this->mockPDO->method('prepare')->willReturn(false); 
    
        ob_start();
    
        $this->configModel->add();
    
        $output = ob_get_clean();
    
        $this->assertEquals('Erreur dans le format de la requête', trim($output));
    }
    
    public function testDeleteInvalidDataInput()
    {
        // Simule des informations POST
        $_POST = [
            'offDelete' => true,
            'off_cat' => 'Invalid Category'
        ];
    
        $this->mockPDO->method('prepare')->willReturn(false); 
    
        ob_start();
    
        $this->configModel->delete();
    
        $output = ob_get_clean();

        $this->assertEquals('Erreur dans le format de requête', trim($output));
    }

    public function testModifyInvalidDataInput()
    {
        // Simule des informations POST
        $_POST = [
            'offModif' => true,
            'off_cat' => 'Invalid Category',
            'off_prix' => 200,
            'off_descrip' => 'Invalid description'
        ];
    
        $this->mockPDO->method('prepare')->willReturn(false); 
    
        ob_start();
    
        $this->configModel->modify();
    
        $output = ob_get_clean();

        $this->assertEquals('Erreur dans le format de la requête', trim($output));
    }
}
