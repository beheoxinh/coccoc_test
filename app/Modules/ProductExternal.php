<?php
//Trait is used to initialize primitive methods, can change and upgrade methods here supporting binding api services or post-processing
namespace App\Modules;

trait ProductExternal{
    //parse data support feature API
    function toJson():string{
        return json_encode(array(
            'id'=>isset($this->id)?$this->id:-1,
            'name'=>$this->name,
            'price'=>$this->price,
            'attributes'=>$this->attributes
        ));
    }

    //parse data extract for logging and testing
    function toString():string{
        return 'name: '.$this->name .', price: '.$this->price .', attribures: '.json_encode($this->attributes);
    }
}