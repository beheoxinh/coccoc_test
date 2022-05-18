<?php
global $config;
require __DIR__ . '/../vendor/autoload.php';


use Raw\DataFaker;

$GLOBALS['config'] = DataFaker::iniCoefficient();
$GLOBALS['orders'] = DataFaker::iniOrder();

echo 'Order: '.$GLOBALS['orders']->toJson() .'<br>';
echo 'Gross price: '.$GLOBALS['orders']->totalPrice();

?>