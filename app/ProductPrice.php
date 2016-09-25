<?php namespace Unicorn;

/**
 * Class ProductPrice
 *
 * @package Unicorn
 */
class ProductPrice
{
    /**
     * @var Money
     */
    protected $price;

    /**
     * @var string
     */
    public $currency;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $taxPercentage;

    /**
     * ProductPrice constructor.
     *
     * @param $price
     * @param $currency
     * @param $name
     * @param int      $taxPercentage
     */
    function __construct($price, $currency = '', $name = '', $taxPercentage = 25)
    {
        $this->price         = new Money($price);
        $this->currency      = $currency;
        $this->name          = $name;
        $this->taxPercentage = $taxPercentage;
    }

    /**
     * @param int $quantity
     *
     * @return Float
     */
    public function getPrice($quantity = 1): Float
    {
        $price = $this->price;
        $fees = $this->calculateFees();
        $taxPercentage = $this->taxPercentage;
        $taxMultiplier = ($taxPercentage + 100) / 100;

        return $price
            ->multiply($quantity)
            ->add($fees)
            ->multiply($taxMultiplier)
            ->toFloat();
    }

    /**
     * @param int $quantity
     *
     * @return Float
     */
    public function getPriceExclTax($quantity = 1): Float
    {
        $price = $this->price;
        $fees = $this->calculateFees();

        return $price
            ->multiply($quantity)
            ->add($fees)
            ->toFloat();
    }

    /**
     * @param int $quantity
     *
     * @return Float
     */
    public function getTax(int $quantity = 1): Float
    {
        $price = $this->price;
        $fees = $this->calculateFees();
        $taxMultiplier = ($this->taxPercentage + 100) / 100;

        return $price
            ->add($fees)
            ->multiply($taxMultiplier)
            ->subtract($price->toFloat())
            ->subtract($fees)
            ->multiply($quantity)
            ->toFloat();
    }

    /**
     * @param int $tax
     */
    public function setTax(int $tax)
    {
        $this->taxPercentage = $tax;
    }

    /**
     * @return int
     */
    public function calculateFees()
    {
        $feeMap = [
            '11334' => 100,
            '11335' => 100,
            '11336' => 100,
            '11337' => 100,
            '11338' => 25,
            '11339' => 100,
            '11341' => 100
        ];
        foreach ($feeMap as $skuNumber => $fee) {
            if (substr($this->name, 4) == $skuNumber) {
                return $fee;
            }
        }
        return 0;
    }

    /////////////////////////////////////////
    // Code kept from the original source. //
    /////////////////////////////////////////
    /**
     * @param $price
     *
     * @param int   $taxPercentage
     */
   function setPrice($price, $taxPercentage = 25)
   {
       $this->taxPercentage = $taxPercentage;
       $this->taxA = $price / 100 * 100;
       $this->price = $price;
   }

    /**
     * @param int    $quantity
     * @param string $method
     */
   function getHtmlPrice($quantity = 1, $method = 'getPrice')
   {
       $html = '<div class="price">%d</div>';
       printf($html . "\n", call_user_func_array($method(), $quantity));
   }
}

