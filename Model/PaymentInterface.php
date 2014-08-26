<?php

namespace CL\DocData\Component\OrderApi\Model;

interface PaymentInterface
{
    const METHOD_DIRECT_DEBIT = 'SEPA_DIRECT_DEBIT';

    const STATUS_NEW        = 1;
    const STATUS_STARTED    = 10;
    const STATUS_AUTHORIZED = 100;

    /**
     * Must return a unique number/string
     * Will be used as a reference in DocData and must be unique there too
     *
     * @return int|string
     */
    public function getId();

    /**
     * @param string $currency
     */
    public function setCurrency($currency);

    /**
     * Must return the currency used for the amount, e.g. 'EUR'
     *
     * @return string
     */
    public function getCurrency();

    /**
     * @param int $amount
     */
    public function setAmount($amount);

    /**
     * Must return an amount in euros without decimals, e.g. 'EUR 12.34' would be '1234'
     *
     * @return int
     */
    public function getAmount();

    /**
     * Add statusUpdates
     *
     * @param PaymentStatusUpdateInterface $statusUpdate
     *
     * @return $this
     */
    public function addStatusUpdate(PaymentStatusUpdateInterface $statusUpdate);

    /**
     * Get statusUpdates
     *
     * @return PaymentStatusUpdateInterface[]
     */
    public function getStatusUpdates();

    /**
     * @return bool
     */
    public function isPaid();
}
