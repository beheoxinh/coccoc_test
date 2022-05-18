<?php
//Applicable to physical products for shipping and ignore by digital products
namespace App\Modules;

trait ProductShipping{
    function feeByWeight($coefficient){
        if($this->isValidAttribute('weight'))
            return $this->attributes['weight']*$coefficient;
        return 0;
    }

    function feeByDimension($coefficient){
        if($this->isValidAttribute('width') && $this->isValidAttribute('height') && $this->isValidAttribute('depth'))
            return $this->attributes['width']*$this->attributes['height']*$this->attributes['depth']*$coefficient;
        return 0;
    }

    /*
    Cost incurred by special factors (includes fee by product type which may be developed in the future)
    value can be negative or positive for the purpose of changing the final shipping fee
    defined separately from the extra_cost attribute managed by the configuration from from 3rd party systems or the order processing staff.
    */
    function specialExtraCost(){
        if($this->isValidAttribute('extra_cost'))
            return $this->attributes['extra_cost'];
        return 0;
    }

    function estimateTotalFee(){
        return max($this->feeByWeight($GLOBALS['config']->cfg_weight_coefficient),$this->feeByDimension($GLOBALS['config']->cfg_dimension_coefficient))+$this->specialExtraCost();
    }

    //Unity function
    private function isValidAttribute($attr){
        if(array_key_exists($attr, $this->attributes) && is_numeric($this->attributes[$attr]))
            return true;
        return false;
    }
}