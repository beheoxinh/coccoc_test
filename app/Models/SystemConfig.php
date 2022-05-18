<?php
//The Configuration is designed to be set up in the SQL database that set up the and update overall system from authorized personnel.
namespace App\Models;

class SystemConfig
{
    function __set($key,$value){
        switch($key){
            case 'cfg_weight_coefficient': {
                $this->cfg_weight_coefficient = $value;
                break;
            }
            case 'cfg_dimension_coefficient':{
                $this->cfg_dimension_coefficient = $value;
                break;
            }
        }
    }

    function __get($key){
        switch($key){
            case 'cfg_weight_coefficient':
                return $this->cfg_weight_coefficient;
            case 'cfg_dimension_coefficient':
                return $this->cfg_dimension_coefficient;
        }
    }
}