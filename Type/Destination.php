<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Destination extends AbstractObject
{
    /**
     * Name of the destination.
     *
     * @var Name
     */
    protected $name;

    /**
     * Address of the destination.
     *
     * @var Address
     */
    protected $address;

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name)
    {
        $this->name = $name;
    }

    /**
     * @return Name
     */
    public function getName()
    {
        return $this->name;
    }
}
