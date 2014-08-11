<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class CreateSuccess extends AbstractRequestSuccess
{
    /**
     * Generated key identifying the merchant and payment order.
     *
     * @var string
     */
    protected $key;

    /**
     * @var PaymentResponse
     */
    protected $paymentResponse;

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param PaymentResponse $paymentResponse
     */
    public function setPaymentResponse(PaymentResponse $paymentResponse)
    {
        $this->paymentResponse = $paymentResponse;
    }

    /**
     * @return PaymentResponse
     */
    public function getPaymentResponse()
    {
        return $this->paymentResponse;
    }
}
