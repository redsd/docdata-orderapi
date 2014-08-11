<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Invoice extends AbstractObject
{
    /**
     * Total net amount for this order.
     *
     * @var Amount
     */
    protected $totalNetAmount;

    /**
     * Total VAT amount for this order.
     *
     * @var Vat
     */
    protected $totalVatAmount;

    /**
     * Information concerning the ordered items.
     *
     * @var array
     */
    protected $item = [];

    /**
     * Name and address to use for shipping.
     *
     * @var Destination
     */
    protected $shipTo;

    /**
     * Additional description concerning the payment order.
     *
     * @var string
     */
    protected $additionalDescription;

    /**
     * @param string $additionalDescription
     */
    public function setAdditionalDescription($additionalDescription)
    {
        $this->additionalDescription = $additionalDescription;
    }

    /**
     * @return string
     */
    public function getAdditionalDescription()
    {
        return $this->additionalDescription;
    }

    /**
     * @param array $item
     */
    public function setItem($item)
    {
        $this->item = $item;
    }

    /**
     * @return array
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param Destination $shipTo
     */
    public function setShipTo(Destination $shipTo)
    {
        $this->shipTo = $shipTo;
    }

    /**
     * @return Destination
     */
    public function getShipTo()
    {
        return $this->shipTo;
    }

    /**
     * @param Amount $totalNetAmount
     */
    public function setTotalNetAmount(Amount $totalNetAmount)
    {
        $this->totalNetAmount = $totalNetAmount;
    }

    /**
     * @return Amount
     */
    public function getTotalNetAmount()
    {
        return $this->totalNetAmount;
    }

    /**
     * @param Vat $totalVatAmount
     */
    public function setTotalVatAmount(Vat $totalVatAmount)
    {
        $this->totalVatAmount = $totalVatAmount;
    }

    /**
     * @return Vat
     */
    public function getTotalVatAmount()
    {
        return $this->totalVatAmount;
    }

    /**
     * Convert object into an array;
     *
     * @return array
     */
    public function toArray()
    {
        $return = parent::toArray();

        var_dump($return['totalVatAmount']);

        return $return;
    }
}
