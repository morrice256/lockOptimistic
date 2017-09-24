<?php

use Morrice256\LockOptimistic\LockOptimistic;

/**
 * Description of LockOptimisticTest
 *
 * @author morrice256
 */
class LockOptimisticBussinesTest extends PHPUnit\Framework\TestCase {

    public function testTraitMethodUpdate(){

        $mock = new Mock();
        $this->assertArrayHasKey( 'updated_at', $mock->update(['updated_at' => "2017-09-21 01:49:41"]) );
        
    }
    
    /**
     * @expectedException Morrice256\LockOptimistic\Exceptions\InvalidArgumentExceptionLockOptismitc
     */
    public function testTraitMethodcheckLabelExistsLabelNULL(){

        $mock = new Mock();
        $mock->update([]);
        
    }
    
    /**
     * @expectedException Morrice256\LockOptimistic\Exceptions\NotFoundArgumentExceptionLockOptismitc
     */
    public function testTraitMethodcheckLabelExistsLabelFail(){

        $mock = new Mock();
        $mock->update( ['another_field' => '2017-09-21 01:49:41'] );
        
    }
    
    /**
     * @expectedException Morrice256\LockOptimistic\Exceptions\InvalidValueExceptionLockOptismitc
     */
    public function testTraitMethodcheckIsInvalideValue(){

        $mock = new Mock();
        $mock->update( ['updated_at' => 'InvalidValue'] );
        
    }
    
    /**
     * @expectedException Morrice256\LockOptimistic\Exceptions\NotFoundValueExceptionLockOptismitc
     */
    public function testTraitMethodcheckIsInvalideValueNull(){

        $mock = new Mock();
        $mock->update( ['updated_at' => ''] );
        
    }
    
}

class MockParent{            
    public function update(array $array){                
        return $array;
    }       
}
        
class Mock extends MockParent{
    use LockOptimistic;
}
        
