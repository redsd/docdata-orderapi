<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Vat extends AbstractObject
{
    /**
     * @var Amount
     */
    protected $amount;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @param Amount $amount
     */
    public function setAmount(Amount $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }
}
