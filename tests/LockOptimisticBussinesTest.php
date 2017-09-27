<?php

use Morrice256\OptimisticLock\LockOptimistic;

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
     * @expectedException Morrice256\OptimisticLock\Exceptions\InvalidArgumentExceptionLockOptismitc
     */
    public function testTraitMethodcheckLabelExistsLabelNULL(){

        $mock = new Mock();
        $mock->update([]);
        
    }
    
    /**
     * @expectedException Morrice256\OptimisticLock\Exceptions\NotFoundArgumentExceptionLockOptismitc
     */
    public function testTraitMethodcheckLabelExistsLabelFail(){

        $mock = new Mock();
        $mock->update( ['another_field' => '2017-09-21 01:49:41'] );
        
    }
    
    /**
     * @expectedException Morrice256\OptimisticLock\Exceptions\InvalidValueExceptionLockOptismitc
     */
    public function testTraitMethodcheckIsInvalideValue(){

        $mock = new Mock();
        $mock->update( ['updated_at' => 'InvalidValue'] );
        
    }
    
    /**
     * @expectedException Morrice256\OptimisticLock\Exceptions\NotFoundValueExceptionLockOptismitc
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
    
    private $primaryKey = 'id';
    
    public function where(){
        return true;
    }
    
    public function first(){
        return true;
    }
    
}
        
