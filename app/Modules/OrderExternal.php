<?php
namespace App\Modules;

use App\Models\Product as Product;

trait OrderExternal{
    public function addProduct(Product $product){
        $this->products[] = $product;
    }

    public function getProductByID($prod_id){
        if(!empty($this->products)){
            foreach ($this->products as $product ) {
                if ($prod_id == $product->id) {
                    return $product;
                }
            }
        }
        return null;
    }

    public function totalPrice(){
        $total_price = 0;
        if(!empty($this->products)){
            foreach ($this->products as $product) {
                if(is_numeric($product->price) && $product->price > 0)
                    $total_price += $product->price+$product->estimateTotalFee();
            }
        }
        return $total_price;
    }

    function toJson():string{
        $products = [];
        foreach ($this->products as $product ) {
            $products[] = $product->toJson();
        }
        return json_encode(array(
            'id'=>isset($this->id)?$this->id:-1,
            'products'=>$products,
            'attributes'=>$this->attributes
        ));
    }
}