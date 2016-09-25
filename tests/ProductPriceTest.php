<?php

use Unicorn\ProductPrice;

class ProductPriceTest extends PHPUnit_Framework_TestCase
{
    public function test_get_price_incl_tax()
    {
        $price = new ProductPrice(100, 'EUR', 'SKU-11334');

        $this->assertEquals(250, $price->getPrice());
    }

    public function test_get_price_excl_tax()
    {
        $price = new ProductPrice(100, 'EUR', 'SKU-11334');

        $this->assertEquals(200, $price->getPriceExclTax());
    }

    public function test_get_price_with_odd_numer()
    {
        $price = new ProductPrice(250, 'USD', 'SKU-11334');

        $this->assertEquals(437.5, $price->getPrice());
    }

    public function test_set_tax()
    {
        $price = new ProductPrice(100, 'EUR', 'SKU-11334');
        $price->setTax(10);

        $this->assertEquals(220, $price->getPrice());
    }

    public function test_set_tax_with_odd_number()
    {
        $price = new ProductPrice(250, 'EUR', 'SKU-11334');
        $price->setTax(29);

        $this->assertEquals(451.5, $price->getPrice());
    }

    public function test_get_tax()
    {
        $price = new ProductPrice(250, 'EUR', 'SKU-11334');

        $this->assertEquals(87.5, $price->getTax());
    }

    public function test_get_tax_with_quantity()
    {
        $price = new ProductPrice(200, 'EUR', 'SKU-11334');

        $this->assertEquals(2025, $price->getTax(27));
    }
}