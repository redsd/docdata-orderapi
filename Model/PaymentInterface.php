<?php

namespace CL\DocData\Component\OrderApi\Model;

interface PaymentInterface
{
    const METHOD_DIRECT_DEBIT = 'SEPA_DIRECT_DEBIT';

    // states belonging to a 'NEW' context
    const STATUS_NEW                   = 1;
    const STATUS_RISK_CHECK_OK         = 2;
    const STATUS_RISK_CHECK_FAILED     = 3;
    const STATUS_AUTHENTICATED         = 4;
    const STATUS_AUTHENTICATION_FAILED = 5;
    const STATUS_AUTHENTICATION_ERROR  = 6;

    // states belonging to a 'STARTED' context
    const STATUS_STARTED              = 10;
    const STATUS_AUTHORIZATION_FAILED = 11;
    const STATUS_AUTHORIZATION_ERROR  = 12;

    // states belonging to a 'CANCELLED' context
    const STATUS_CANCELLED = 20;

    // states belonging to a 'AUTHORIZED/PAID' context
    const STATUS_AUTHORIZED = 50;
    const STATUS_PAID       = 100;


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
