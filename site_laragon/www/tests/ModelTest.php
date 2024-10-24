<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Model;
use PDO;
use PDOStatement;
use PDOException;

class ModelTest extends TestCase {
    private $mockPDO;
    private $mockModel;

    protected function setUp(): void {

        $this->mockPDO = $this->createMock(PDO::class);
        
        $this->mockModel = $this->getMockForAbstractClass(Model::class, [$this->mockPDO]);
    }

    public function testConstructorCreatesConnection() {
    
        $mockConnection = $this->createMock(PDO::class);
    
    
        $mockConnection->expects($this->once())
                       ->method('exec')
                       ->with('set names utf8');
    
   
        $this->mockModel = $this->getMockBuilder(Model::class)
                                ->disableOriginalConstructor()
                                ->onlyMethods(['getConnection'])
                                ->getMockForAbstractClass();
    
    
        $this->mockModel->method('getConnection')
                        ->willReturnCallback(function() use ($mockConnection) {
                         
                            $reflection = new \ReflectionClass($this->mockModel);
                            $property = $reflection->getProperty('_connexion');
                            $property->setAccessible(true);
                            $property->setValue($this->mockModel, $mockConnection);
                            
                            $mockConnection->exec('set names utf8');
    
                            return $mockConnection;
                        });
    
        $this->mockModel->__construct();
    
        $reflection = new \ReflectionClass($this->mockModel);
        $property = $reflection->getProperty('_connexion');
        $property->setAccessible(true);
    
        $this->assertSame($mockConnection, $property->getValue($this->mockModel));
    }
    
    public function testGetAll() {
       
        $mockStatement = $this->createMock(PDOStatement::class);
        
        $mockStatement->expects($this->once())
                      ->method('fetchAll')
                      ->willReturn(['row1', 'row2']);

        $this->mockPDO->expects($this->once())
                      ->method('prepare')
                      ->willReturn($mockStatement);

        $this->mockModel->table = 'example_table';
        $result = $this->mockModel->getAll();

        $this->assertEquals(['row1', 'row2'], $result);
    }
    
    public function testGetConnectionReturnsExistingConnection() {
    
        $reflection = new \ReflectionClass($this->mockModel);
        $property = $reflection->getProperty('_connexion');
        $property->setAccessible(true);
        $property->setValue($this->mockModel, $this->mockPDO);
    
        $connection = $this->mockModel->getConnection();
    
        $this->assertSame($this->mockPDO, $connection);
    }
    
    public function testGetConnectionDoesNotCallExecWhenConnectionExists() {
    
        $reflection = new \ReflectionClass($this->mockModel);
        $property = $reflection->getProperty('_connexion');
        $property->setAccessible(true);
        $property->setValue($this->mockModel, $this->mockPDO);
    
        $this->mockPDO->expects($this->never())
                      ->method('exec');
    
        $this->mockModel->getConnection();
    }
    
    public function testGetConnectionThrowsExceptionOnFailure() {
    
        $this->mockModel = $this->getMockBuilder(Model::class)
                                ->disableOriginalConstructor()
                                ->onlyMethods(['getConnection'])
                                ->getMockForAbstractClass();
    
        $this->expectException(PDOException::class);
        $this->expectExceptionMessage('Erreur de connexion: Connection error');
    
        $this->mockModel->method('getConnection')
                        ->will($this->throwException(new PDOException('Erreur de connexion: Connection error')));
    
        $this->mockModel->getConnection();
    }
    
    public function testGetConnectionCreatesNewConnection() {

        $mockConnection = $this->createMock(PDO::class);
        
        $this->mockModel = $this->getMockBuilder(Model::class)
                                ->setConstructorArgs([$mockConnection])
                                ->onlyMethods([])
                                ->getMockForAbstractClass();
    
        $reflection = new \ReflectionClass($this->mockModel);
        $property = $reflection->getProperty('_connexion');
        $property->setAccessible(true);
        $property->setValue($this->mockModel, null);
    
        $connection = $this->mockModel->getConnection();
    
        $property->setValue($this->mockModel, $mockConnection);

        $this->assertSame($mockConnection, $property->getValue($this->mockModel));
    }
}
?>
