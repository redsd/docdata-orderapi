<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class PaymentPreferences extends AbstractObject
{
    /**
     * The profile that is used to select the payment methods that can be used
     * to pay this order. Defaults to 'standard', which always has to exist.
     *
     * @var string
     */
    protected $profile = 'standard';

    /**
     * @var int
     */
    protected $numberOfDaysToPay = 5;

    /**
     * @var mixed
     */
    protected $exhortation;

    /**
     * The expected number of days in which the payment should be processed, or
     * be expired if not paid.
     *
     * @param int $numberOfDaysToPay
     */
    public function setNumberOfDaysToPay($numberOfDaysToPay)
    {
        $this->numberOfDaysToPay = $numberOfDaysToPay;
    }

    /**
     * @return int
     */
    public function getNumberOfDaysToPay()
    {
        return $this->numberOfDaysToPay;
    }

    /**
     * @param string $profile
     */
    public function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return string
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $exhortation
     */
    public function setExhortation($exhortation)
    {
        $this->exhortation = $exhortation;
    }

    /**
     * @return mixed
     */
    public function getExhortation()
    {
        return $this->exhortation;
    }
}
