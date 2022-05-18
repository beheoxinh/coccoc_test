<?php

namespace App\Models;

use App\Modules\OrderExternal as OrderExternal;

class Order
{
    protected int $id; //automatically deployed by sql id generator
    protected $products= [];
    protected $attributes = []; //support extended attributes such as discount code, order time and other additional information not available at the moment

    function __set($key,$value){
        if($key == 'id') return;
        switch($key){
            case 'id':
                break;
            case 'products':{
                $this->products = $value;
                break;
            }
            default :{
                $this->attributes[$key] = $value;
                break;
            }
        }
    }

    function __get($key){
        switch($key){
            case 'id':{
                return $this->id;
                break;
            }
            case 'products':{
                return $this->products;
                break;
            }
            default:{
                if (!array_key_exists($key, $this->attributes))
                    return null;
                return $this->attributes[$key];
            }
        }
    }

    use OrderExternal;
    //ID force change support DEV, Admin develop system
    public function forceChangeID($id){
        $this->id = $id;
    }
}