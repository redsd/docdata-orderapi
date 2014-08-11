<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Amount extends AbstractObject
{
    /**
     * @var int
     */
    private $_;

    /**
     * @var string
     */
    private $currency = 'EUR';

    /**
     * @param int $number
     */
    public function __construct($number)
    {
        $this->_ = $number;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Convert the object into an array
     *
     * @return array
     */
    public function toArray()
    {
        return [
            '_'        => $this->_,
            'currency' => $this->getCurrency()
        ];
    }
}
