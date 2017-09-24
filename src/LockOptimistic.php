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

trait LockOptimistic {

    private $config;
    
    public function update(array $array){

        if(!$this->config){
            $this->config = include('./config/lockoptmistic.php');
        }
        
        $this->checkLabelExists($array);
        
        $this->checkIsValideValue($array);
        
        return parent::update($array);

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
    
}
