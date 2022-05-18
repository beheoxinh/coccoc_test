<?php

namespace Tests;

use App\CommonProduct;
use App\Models\Order;
use App\Models\SystemConfig;
use App\Modules\OrderExternal;
use App\Modules\ProductShipping;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testWeightFee()
    {
        $coefficient = rand(5,50);
        $product = new CommonProduct();
        $product->weight = rand(1,20);
        $standard_weight_fee = $product->weight * $coefficient;

        $this->assertSame($standard_weight_fee,$product->feeByWeight($coefficient));
    }
    
    public function testDimensionFee()
    {
        $coefficient = rand(5,50);
        $product = new CommonProduct();
        $product->width = rand(1,20);
        $product->height = rand(1,20);
        $product->depth = rand(1,20);
        $standard_dimension_fee = $product->width * $product->height * $product->depth * $coefficient;

        $this->assertSame($standard_dimension_fee,$product->feeByDimension($coefficient));
    }

    public function testShippingFee()
    {
        $weight_coefficient = rand(5,50);
        $dimension_coefficient = rand(5,50);

        $GLOBALS['config'] = new SystemConfig();
        $GLOBALS['config']->cfg_weight_coefficient = $weight_coefficient;
        $GLOBALS['config']->cfg_dimension_coefficient = $dimension_coefficient;

        $product = new CommonProduct();
        $product->width = rand(1,20);
        $product->height = rand(1,20);
        $product->depth = rand(1,20);
        $product->weight = rand(1,20);

        $standard_weight_fee = $product->weight * $weight_coefficient;
        $standard_dimension_fee = $product->width * $product->height * $product->depth * $dimension_coefficient;

        $standerd_shipping_fee = max($standard_weight_fee,$standard_dimension_fee);
 
        $this->assertSame($standerd_shipping_fee,$product->estimateTotalFee());
    }

    public function testGrossPrice()
    {
        $standerd_gross_price = 0;

        $weight_coefficient = rand(5,50);
        $dimension_coefficient = rand(5,50);

        $GLOBALS['config'] = new SystemConfig();
        $GLOBALS['config']->cfg_weight_coefficient = $weight_coefficient;
        $GLOBALS['config']->cfg_dimension_coefficient = $dimension_coefficient;

        $order = new Order();

        for($i=0;$i<100;$i++){
            $product = new CommonProduct();
            $product->price = rand(1,1000000);
            $product->width = rand(1,20);
            $product->height = rand(1,20);
            $product->depth = rand(1,20);
            $product->weight = rand(1,20);
            $product->forceChangeID($i);

            $order->addProduct($product);

            $standerd_item_price = $product->price + $product->estimateTotalFee();
            $standerd_gross_price += $standerd_item_price;
        }

        $this->assertSame($standerd_gross_price,$order->totalPrice());
    }
}