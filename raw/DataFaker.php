<?php
namespace Raw;

use App\CommonProduct;
use App\Models\Order;
use App\Models\SystemConfig;

class DataFaker{
    public static function iniCoefficient(): SystemConfig
    {
        $config = new SystemConfig();
        $config->cfg_weight_coefficient = 11;
        $config->cfg_dimension_coefficient = 11;

        return $config;
    }

    public static function iniOrder(): Order
    {
        $order = new Order();
        $order->forceChangeID(1);

        for($i=0;$i<3;$i++){
            $product = new CommonProduct();
            $product->name = "Test Product";
            $product->price = rand(10000,50000);
            $product->width = rand(1,5);
            $product->height = rand(1,5);
            $product->depth = rand(1,5);
            $product->weight = rand(1,10);
            $product->forceChangeID($i+1);

            $order->addProduct($product);
        }

        return $order;
    }
}