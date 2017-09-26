<?php

namespace Morrice256\LockOptimistic;

/**
 * Description of LockOptimistic
 *
 * @author morrice256
 * 
 */
use Morrice256\LockOptimistic\Exceptions\InvalidArgumentExceptionLockOptismitc;
use Morrice256\LockOptimistic\Exceptions\NotFoundArgumentExceptionLockOptismitc;
use Morrice256\LockOptimistic\Exceptions\NotFoundValueExceptionLockOptismitc;
use Morrice256\LockOptimistic\Exceptions\InvalidValueExceptionLockOptismitc;
use Morrice256\LockOptimistic\Exceptions\ReferenceObjectExceptionLockOptismitc;

trait LockOptimistic {

    private $config;
    
    public function update(array $array){

        if(!$this->config){
            $this->config = include('./config/lockoptmistic.php');
        }
        
        $this->callValidations( $array );
        
        return parent::update($array);

    }
    
    public function save(){

        if(!$this->config){
            $this->config = include('./config/lockoptmistic.php');
        }
            
        $primaryKey = $this->primaryKey;
        
        if( property_exists($this, $primaryKey) && $this->$primaryKey != null){
            
           $this->callValidations( get_object_vars( $this ) );
            
        }
        
        return parent::save();

    }
    
    private function callValidations(array $array){
        
        $this->checkLabelExists($array);
        
        $this->checkIsValideValue($array);
        
        $this->checkValue( $array );
        
    }

    private function checkLabelExists(array $array){
        
        if( empty($array)) {
            throw new InvalidArgumentExceptionLockOptismitc();
        }
        
        if(!isset( $this->config['audit'] ) 
                || !isset($array[ $this->config['audit']['field_name'] ])) {
            throw new NotFoundArgumentExceptionLockOptismitc();
        }
        
    }
    
    private function checkIsValideValue(array $array){
        
        $value = (string) trim( $array[ $this->config['audit']['field_name'] ] );
        
        if( !$value || $value == '' ) {
            throw new NotFoundValueExceptionLockOptismitc();
        }
        
        $method = $this->config['audit']['value_type'].'CheckValue';

        if (!method_exists($this, $method)) {
            throw new InvalidValueExceptionLockOptismitc();
        } else {
            $this->$method( $value );
        }
       
        
    }
    
    private function timestampCheckValue($value){
        
        if (($timestamp = strtotime($value)) === false) {

            throw new InvalidValueExceptionLockOptismitc();
        } 
        
    }
    
    private function checkValue(array $array){
        
        $primaryKey = $this->primaryKey;
         
        $return = $this->where($primaryKey, $this->$primaryKey)
                       ->where($this->config['audit']['field_name'], $array[ $this->config['audit']['field_name'] ])
                       ->get();
        
        if(!$return){
            throw new ReferenceObjectExceptionLockOptismitc();
        }
        
    }
    
}
