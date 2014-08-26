<?php

namespace CL\DocData\Component\OrderApi\Model;

abstract class AbstractPaymentStatusUpdate implements PaymentStatusUpdateInterface
{
    /**
     * {@inheritdoc}
     */
    protected $id;

    /**
     * @var PaymentInterface
     */
    protected $payment;

    /**
     * {@inheritdoc}
     */
    protected $status ;

    /**
     * @var array
     */
    private $allowedStatuses = [
        PaymentInterface::STATUS_NEW,
        PaymentInterface::STATUS_STARTED,
        PaymentInterface::STATUS_AUTHORIZED,
    ];

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setPayment(PaymentInterface $payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        if (!in_array($status, $this->allowedStatuses)) {
            throw new \InvalidArgumentException(sprintf(
                'Status must be one of ("%s"), "%s" given',
                implode('","', $this->allowedStatuses),
                $status
            ));
        }

        $this->status = $status;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }
}
