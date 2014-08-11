<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class Authorization extends AbstractObject
{
    /**
     * @var AuthorizationStatus
     */
    protected $status;

    /**
     * @var Amount
     */
    protected $amount;

    /**
     * @var string
     */
    protected $confidenceLevel;

    /**
     * @var Capture
     */
    protected $capture;

    /**
     * @var Refund
     */
    protected $refund;

    /**
     * @var Chargeback
     */
    protected $chargeback;

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
     * @param Capture $capture
     */
    public function setCapture($capture)
    {
        $this->capture = $capture;
    }

    /**
     * @return Capture
     */
    public function getCapture()
    {
        return $this->capture;
    }

    /**
     * @param Chargeback $chargeback
     */
    public function setChargeback($chargeback)
    {
        $this->chargeback = $chargeback;
    }

    /**
     * @return Chargeback
     */
    public function getChargeback()
    {
        return $this->chargeback;
    }

    /**
     * @param string $confidenceLevel
     */
    public function setConfidenceLevel($confidenceLevel)
    {
        $this->confidenceLevel = $confidenceLevel;
    }

    /**
     * @return string
     */
    public function getConfidenceLevel()
    {
        return $this->confidenceLevel;
    }

    /**
     * @param Refund $refund
     */
    public function setRefund($refund)
    {
        $this->refund = $refund;
    }

    /**
     * @return Refund
     */
    public function getRefund()
    {
        return $this->refund;
    }

    /**
     * @param AuthorizationStatus $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return AuthorizationStatus
     */
    public function getStatus()
    {
        return $this->status;
    }
}
