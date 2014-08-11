<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Item extends AbstractObject
{
    /**
     * The human-readable name of this item.
     *
     * @var string
     */
    protected $name;

    /**
     * A code or article number identifying this item.
     *
     * @var string
     */
    protected $code;

    /**
     * Quantity of this item that's being ordered.
     *
     * @var int
     */
    protected $quantity;

    /**
     * The description of the item.
     *
     * @var string
     */
    protected $description;

    /**
     * URL pointing to the location of the order item's    image. The image itself
     * can be subject to certain limitations on file size and image dimensions,
     * defined by docdata.
     *
     * @var string
     */
    protected $image;

    /**
     * The net amount for a single piece of this item.
     *
     * @var Amount
     */
    protected $netAmount;

    /**
     * The gross amount for a single piece of this item.
     *
     * @var Amount
     */
    protected $grossAmount;

    /**
     * The VAT amount for a single piece of this item.
     *
     * @var Vat
     */
    protected $vat;

    /**
     * The total net amount for this item.
     *
     * @var Amount
     */
    protected $totalNetAmount;

    /**
     * The total gross amount for this item.
     *
     * @var Amount
     */
    protected $totalGrossAmount;

    /**
     * The total VAT amount for this item.
     *
     * @var Vat
     */
    protected $totalVat;

    /**
     * @var int
     */
    protected $number;

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Amount $grossAmount
     */
    public function setGrossAmount(Amount $grossAmount)
    {
        $this->grossAmount = $grossAmount;
    }

    /**
     * @return Amount
     */
    public function getGrossAmount()
    {
        return $this->grossAmount;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Amount $netAmount
     */
    public function setNetAmount(Amount $netAmount)
    {
        $this->netAmount = $netAmount;
    }

    /**
     * @return Amount
     */
    public function getNetAmount()
    {
        return $this->netAmount;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param Amount $totalGrossAmount
     */
    public function setTotalGrossAmount(Amount $totalGrossAmount)
    {
        $this->totalGrossAmount = $totalGrossAmount;
    }

    /**
     * @return Amount
     */
    public function getTotalGrossAmount()
    {
        return $this->totalGrossAmount;
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
     * @param Vat $totalVat
     */
    public function setTotalVat(Vat $totalVat)
    {
        $this->totalVat = $totalVat;
    }

    /**
     * @return Vat
     */
    public function getTotalVat()
    {
        return $this->totalVat;
    }

    /**
     * @param Vat $vat
     */
    public function setVat(Vat $vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return Vat
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * @param string $code
     * @param string $name
     * @param int    $quantity
     * @param string $description
     * @param Amount $netAmount
     * @param Amount $grossAmount
     * @param Vat    $vat
     */
    public function __construct(
        $number,
        $code,
        $name,
        $quantity,
        $description,
        Amount $netAmount,
        Amount $grossAmount,
        Vat $vat
    )
    {
        $this->setNumber($number);
        $this->setCode($code);
        $this->setName($name);
        $this->setQuantity($quantity);
        $this->setDescription($description);
        $this->setNetAmount($netAmount);
        $this->setGrossAmount($grossAmount);
        $this->setVat($vat);
    }

    /**
     * Convert object into an array;
     *
     * @return array
     */
    public function toArray()
    {
        $return                     = parent::toArray();
        $return['totalNetAmount']   = $return['quantity']['_'] * $return['netAmount']['_'];
        $return['totalGrossAmount'] = $return['quantity']['_'] * $return['grossAmount']['_'];
        $return['totalVat']         = $return['quantity']['_'] * $return['vat']['amount']['_'];

        return $return;
    }
}
