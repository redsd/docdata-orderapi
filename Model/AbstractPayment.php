<?php

namespace CL\DocData\Component\OrderApi\Model;

abstract class AbstractPayment implements PaymentInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $docDataOrderKey;

    /**
     * @var PaymentStatusUpdateInterface[]
     */
    protected $statusUpdates;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * {@inheritdoc}
     */
    public function setAmount($amount)
    {
        $this->amount = str_replace('.', '', $amount);
    }

    /**
     * {@inheritdoc}
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $docDataOrderKey
     */
    public function setDocDataOrderKey($docDataOrderKey)
    {
        $this->docDataOrderKey = $docDataOrderKey;
    }

    /**
     * @return string
     */
    public function getDocDataOrderKey()
    {
        return $this->docDataOrderKey;
    }

    /**
     * {@inheritdoc}
     */
    public function addStatusUpdate(PaymentStatusUpdateInterface $statusUpdate)
    {
        $statusUpdate->setPayment($this);

        $this->statusUpdates[] = $statusUpdate;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatusUpdates()
    {
        return $this->statusUpdates;
    }

    /**
     * @return bool
     */
    public function isPaid()
    {
        foreach ($this->getStatusUpdates() as $statusUpdate) {
            if ($statusUpdate->getStatus() === PaymentInterface::STATUS_AUTHORIZED) {
                // TODO make more strict?
                return true;
            }
        }

        return false;
    }
}
