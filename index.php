<?php
require __DIR__.'/vendor/autoload.php';

$prices = [];
$prices[] = new Unicorn\ProductPrice(200, 'EUR', 'SKU-11334');
$prices[] = new Unicorn\ProductPrice(250, 'USD', 'SKU-11334');
$prices[] = new Unicorn\ProductPrice(252, 'USD', 'SKU-11335');
$prices[] = new Unicorn\ProductPrice(550, 'USD', 'SKU-11336');
$prices[] = new Unicorn\ProductPrice(530, 'USD', 'SKU-11337');
$prices[] = new Unicorn\ProductPrice(133, 'USD', 'SKU-11338');
$prices[] = new Unicorn\ProductPrice(441, 'USD', 'SKU-11339');
$prices[] = new Unicorn\ProductPrice(867, 'USD', 'SKU-11341');
$prices[3]->setTax(15);

$quantity = 55;

include 'home.php';