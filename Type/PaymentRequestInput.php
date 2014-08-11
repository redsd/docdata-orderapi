<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class PaymentRequestInput extends AbstractObject
{
    /**
     * Payment method to be used.
     *
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var Amount
     */
    protected $paymentAmount;

    /**
     * @var AmexPaymentInput
     */
    protected $amexPaymentInput;

    /**
     * @var MasterCardPaymentInput
     */
    protected $masterCardPaymentInput;

    /**
     * @var VisaPaymentInput
     */
    protected $visaPaymentInput;

    /**
     * @var DirectDebitPaymentInput
     */
    protected $directDebitPaymentInput;

    /**
     * @var BankTransferPaymentInput
     */
    protected $bankTransferPaymentInput;

    /**
     * @var elvPaymentInput
     */
    protected $elvPaymentInput;

    /**
     * @param AmexPaymentInput $amexPaymentInput
     */
    public function setAmexPaymentInput($amexPaymentInput)
    {
        $this->amexPaymentInput = $amexPaymentInput;
    }

    /**
     * @return AmexPaymentInput
     */
    public function getAmexPaymentInput()
    {
        return $this->amexPaymentInput;
    }

    /**
     * @param BankTransferPaymentInput $bankTransferPaymentInput
     */
    public function setBankTransferPaymentInput($bankTransferPaymentInput)
    {
        $this->bankTransferPaymentInput = $bankTransferPaymentInput;
    }

    /**
     * @return BankTransferPaymentInput
     */
    public function getBankTransferPaymentInput()
    {
        return $this->bankTransferPaymentInput;
    }

    /**
     * @param DirectDebitPaymentInput $directDebitPaymentInput
     */
    public function setDirectDebitPaymentInput($directDebitPaymentInput)
    {
        $this->directDebitPaymentInput = $directDebitPaymentInput;
    }

    /**
     * @return DirectDebitPaymentInput
     */
    public function getDirectDebitPaymentInput()
    {
        return $this->directDebitPaymentInput;
    }

    /**
     * @param elvPaymentInput $elvPaymentInput
     */
    public function setElvPaymentInput($elvPaymentInput)
    {
        $this->elvPaymentInput = $elvPaymentInput;
    }

    /**
     * @return elvPaymentInput
     */
    public function getElvPaymentInput()
    {
        return $this->elvPaymentInput;
    }

    /**
     * @param MasterCardPaymentInput $masterCardPaymentInput
     */
    public function setMasterCardPaymentInput($masterCardPaymentInput)
    {
        $this->masterCardPaymentInput = $masterCardPaymentInput;
    }

    /**
     * @return MasterCardPaymentInput
     */
    public function getMasterCardPaymentInput()
    {
        return $this->masterCardPaymentInput;
    }

    /**
     * @param Amount $paymentAmount
     */
    public function setPaymentAmount($paymentAmount)
    {
        $this->paymentAmount = $paymentAmount;
    }

    /**
     * @return Amount
     */
    public function getPaymentAmount()
    {
        return $this->paymentAmount;
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

    /**
     * @param VisaPaymentInput $visaPaymentInput
     */
    public function setVisaPaymentInput($visaPaymentInput)
    {
        $this->visaPaymentInput = $visaPaymentInput;
    }

    /**
     * @return VisaPaymentInput
     */
    public function getVisaPaymentInput()
    {
        return $this->visaPaymentInput;
    }
}
