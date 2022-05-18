<?php

namespace App;

use App\Models\Product as Product;
use App\Modules\ProductExternal as ProductExternal;
use App\Modules\ProductShipping as ProductShipping;
use App\Pattern\ProductDataParse as ProductDataParse;

class CommonProduct extends Product implements ProductDataParse
{
    use ProductShipping, ProductExternal;
}