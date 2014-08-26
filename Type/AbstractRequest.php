<?php

namespace CL\DocData\Component\OrderApi\Type;

use CL\DocData\Component\OrderApi\ApiClient;

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
     * Payment order key belonging to the order which needs to be processed.
     *
     * @var string
     */
    protected $paymentOrderKey;

    /**
     * @var string
     */
    protected $version = ApiClient::VERSION;

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
