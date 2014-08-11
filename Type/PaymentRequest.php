<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class PaymentRequest extends AbstractObject
{
    /**
     * @var PaymentReference
     */
    protected $initialPaymentReference;

    /**
     * @param PaymentReference $initialPaymentReference
     */
    public function setInitialPaymentReference($initialPaymentReference)
    {
        $this->initialPaymentReference = $initialPaymentReference;
    }

    /**
     * @return PaymentReference
     */
    public function getInitialPaymentReference()
    {
        return $this->initialPaymentReference;
    }
}
