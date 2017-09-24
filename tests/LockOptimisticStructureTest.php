<?php

use Morrice256\LockOptimistic\LockOptimistic;

/**
 * Description of LockOptimisticTest
 *
 * @author morrice256
 */
class LockOptimisticStructureTest extends PHPUnit\Framework\TestCase {

    /**
     * This test check if the method exists in trait.
     * Because this method is essential to feature
     */
    public function testUpdatMethodExists(){
        $mock = $this->getMockForTrait(LockOptimistic::class);
        $this->assertTrue( method_exists($mock, 'update') );
    }
    
    public function testUpdateMethodWithOnlyOneArgs(){
        $method = new ReflectionMethod( LockOptimistic::class , 'update');
        $this->assertEquals( 1, $method->getNumberOfParameters() );
    }
    
    public function testConfigFileExists(){
        $config = './config/lockoptmistic.php';
        $this->assertTrue( file_exists($config) );
    }        
    
    public function testConfigFileKeys(){
        $config = include('./config/lockoptmistic.php');
        $this->assertArrayHasKey('audit', $config);
        $this->assertArrayHasKey('field_name', $config['audit']);
        $this->assertArrayHasKey('value_type', $config['audit']);

        $this->assertArrayHasKey('result', $config);        
        $this->assertArrayHasKey('type', $config['result']);
    }
    
    public function testcheckLabelExistsMethodExists(){
        $mock = $this->getMockForTrait(LockOptimistic::class);
        $this->assertTrue( method_exists($mock, 'checkLabelExists') );
    }
    
    public function testcheckLabelExistsMethodWithOnlyOneArgs(){
        $method = new ReflectionMethod( LockOptimistic::class , 'checkLabelExists');
        $this->assertEquals( 1, $method->getNumberOfParameters() );
    }
    
    public function testcheckIsValideValueMethodExists(){
        $mock = $this->getMockForTrait(LockOptimistic::class);
        $this->assertTrue( method_exists($mock, 'checkIsValideValue') );
    }
    
    public function testcheckIsValideValueMethodWithOnlyOneArgs(){
        $method = new ReflectionMethod( LockOptimistic::class , 'checkIsValideValue');
        $this->assertEquals( 1, $method->getNumberOfParameters() );
    }

}
