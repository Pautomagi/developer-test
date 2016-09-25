<?php namespace Unicorn;

/**
 * Class Money
 *
 * @package Unicorn
 */
class Money
{
    const SCALE = 2;

    /**
     * @var int
     */
    private $value;

    /**
     * Money constructor.
     *
     * @param $value
     *
     * @throws \Exception
     */
    public function __construct($value)
    {
        if ($value instanceof Money) {
            $this->value = $value->value;
        } else {
            if ( !is_numeric($value) ) throw new \Exception('Money unit value invalid.');
            $this->value = (string)$value;
        }
    }

    /**
     * @param int $operand
     *
     * @return Money
     */
    public function multiply($operand): Money
    {
        if ($operand instanceof Money) {
            return new Money(bcmul($this->value, $operand->value, static::SCALE));
        } else {
            return new Money(bcmul($this->value, $operand, static::SCALE));
        }
    }

    /**
     * @param int $operand
     *
     * @return Money
     */
    public function add($operand): Money
    {
        if ($operand instanceof Money) {
            return new Money(bcadd($this->value, $operand->value, static::SCALE));
        } else {
            return new Money(bcadd($this->value, $operand, static::SCALE));
        }
    }

    /**
     * @param int $operand
     *
     * @return Money
     */
    public function subtract($operand): Money
    {
        if ($operand instanceof Money) {
            return new Money(bcsub($this->value, $operand->value, static::SCALE));
        } else {
            return new Money(bcsub($this->value, $operand, static::SCALE));
        }
    }

    /**
     *  @return float
     */
    public function toFloat()
    {
        return (float)$this->value;
    }
}