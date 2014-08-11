<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Payment extends AbstractObject
{
    /**
     * @var string
     */
    protected $id;

    /**
     * Payment method used for the payment.
     *
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var Authorization
     */
    protected $authorization;

    /**
     * @var PaymentInfo
     */
    protected $extended;

    /**
     * @param Authorization $authorization
     */
    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;
    }

    /**
     * @return Authorization
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }
}
