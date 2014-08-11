<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class IDealPaymentInfo extends AbstractObject
{
    /**
     * @var string
     */
    protected $issuerId;

    /**
     * @param string $issuerId
     */
    public function setIssuerId($issuerId)
    {
        $this->issuerId = $issuerId;
    }

    /**
     * @return string
     */
    public function getIssuerId()
    {
        return $this->issuerId;
    }
}
