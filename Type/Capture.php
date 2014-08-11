<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Capture extends AbstractObject
{
    /**
     * @var string
     */
    protected $merchantCaptureId;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var Amount
     */
    protected $amount;

    /**
     * @var string
     */
    protected $reason;

    /**
     * @param Amount $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $merchantCaptureId
     */
    public function setMerchantCaptureId($merchantCaptureId)
    {
        $this->merchantCaptureId = $merchantCaptureId;
    }

    /**
     * @return string
     */
    public function getMerchantCaptureId()
    {
        return $this->merchantCaptureId;
    }

    /**
     * @param string $reason
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
