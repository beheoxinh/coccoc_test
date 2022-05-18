<?php

namespace App;

use App\Models\Product as Product;
use App\Modules\ProductExternal as ProductExternal;
use App\Pattern\ProductDataParse as ProductDataParse;

class DigitalProduct extends Product implements ProductDataParse
{
    use ProductExternal;
}