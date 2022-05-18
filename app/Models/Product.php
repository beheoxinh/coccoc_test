<?php

namespace App\Models;

abstract class Product
{
    protected int $id; //automatically deployed by sql id generator
    protected string $name = '';
    protected float $price = 0.0;
    protected $attributes= []; //dynamic attributes unlimit feature options

    function __set($key,$value){
        if($key == 'id') return;
        switch($key){
            case 'id':
                break;
            case 'name': {
                $this->name = $value;
                break;
            }
            case 'price':{
                $this->price = $value;
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
            case 'name':{
                return $this->name;
                break;
            }
            case 'price':{
                return $this->price;
                break;
            }
            default:{
                if (!array_key_exists($key, $this->attributes))
                    return null;
                return $this->attributes[$key];
            }
        }
    }

    //ID force change support DEV, Admin develop system
    public function forceChangeID($id){
        $this->id = $id;
    }
}