<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * DocDataPayments PaymentResponse class
 *
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class PaymentResponse extends AbstractObject
{
    /**
     * @var mixed
     */
    protected $paymentSuccess;

    /**
     * @var mixed
     */
    protected $paymentInsufficientData;

    /**
     * @var mixed
     */
    protected $paymentError;
}
