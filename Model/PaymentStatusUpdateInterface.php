<?php

namespace CL\DocData\Component\OrderApi\Model;

interface PaymentStatusUpdateInterface
{
    /**
     * Set payment
     *
     * @param PaymentInterface $payment
     *
     * @return $this
     */
    public function setPayment(PaymentInterface $payment);

    /**
     * Get payment
     *
     * @return PaymentInterface
     */
    public function getPayment();

    /**
     * @param int $status
     */
    public function setStatus($status);

    /**
     * @return int
     */
    public function getStatus();
}
