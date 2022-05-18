<?php

namespace App\Controllers;

use App\Models\SystemConfig as SystemConfig;

class ShippingController extends Controller{
    function getCoefficient(){
        $system = new SystemConfig();
        //query on SQL or use ORM to get data
        return array('weight_coefficient'=>$system->cfg_weight_coefficient,'dimension_coefficient'=>$system->cfg_dimension_coefficient);
    }
}