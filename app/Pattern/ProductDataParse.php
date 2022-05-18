<?php

namespace App\Pattern;

interface ProductDataParse{
    public function toJson() : string;
    public function toString() : string;
}