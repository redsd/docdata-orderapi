<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class StartRequest extends AbstractRequest
{
    /**
     * Payment order key belonging to the order which needs to be canceled.
     *
     * @var string
     */
    protected $paymentOrderKey;

    /**
     * Optionally specifies the details needed for starting a payment for a shopper without showing the hosted
     * payment pages. Must be specified if not a subsequent recurring payment.
     *
     * @var PaymentRequestInput
     */
    protected $payment;

    /**
     * Optionally specifies a request for a recurring payment. It should target an existing previous payment that will
     * be used to start a new payment with directly. Reservations are also made as the starting point for upcoming
     * repeated payments if needed. Must be specified if not giving direct payment request input.
     *
     * @var PaymentRequest
     */
    protected $recurringPaymentRequest;

    /**
     * @param PaymentRequest $recurringPaymentRequest
     */
    public function setRecurringPaymentRequest(PaymentRequest $recurringPaymentRequest)
    {
        $this->recurringPaymentRequest = $recurringPaymentRequest;
    }

    /**
     * @return PaymentRequest
     */
    public function getRecurringPaymentRequest()
    {
        return $this->recurringPaymentRequest;
    }

    /**
     * @param PaymentRequestInput $payment
     */
    public function setPayment(PaymentRequestInput $payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return PaymentRequestInput
     */
    public function getPayment()
    {
        return $this->payment;
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
