<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
abstract class AbstractRequest extends AbstractObject
{
    /**
     * Merchant credentials.
     *
     * @var Merchant
     */
    protected $merchant;

    /**
     * Payment order key belonging to the order which needs to be canceled.
     *
     * @var string
     */
    protected $paymentOrderKey;

    /**
     * @var string
     */
    protected $version = '1.1';

    /**
     * @param Merchant $merchant
     */
    public function setMerchant(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * @return Merchant
     */
    public function getMerchant()
    {
        return $this->merchant;
    }

    /**
     * @param string $paymentOrderKey
     */
    public function setPaymentOrderKey($paymentOrderKey)
    {
        $this->paymentOrderKey = $paymentOrderKey;
    }

    /**
     * @return string
     */
    public function getPaymentOrderKey()
    {
        return $this->paymentOrderKey;
    }
}
