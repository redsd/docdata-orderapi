<?php

namespace CL\DocData\Component\OrderApi\Type;

class DirectDebitPaymentInput extends AbstractObject
{
    /**
     * @var string
     */
    protected $holderName;

    /**
     * @var string
     */
    protected $holderCity;

    /**
     * @var string
     */
    protected $holderCountry;

    /**
     * @var string
     */
    protected $bic;

    /**
     * @var string
     */
    protected $iban;

    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $holderCity
     */
    public function setHolderCity($holderCity)
    {
        $this->holderCity = $holderCity;
    }

    /**
     * @return string
     */
    public function getHolderCity()
    {
        return $this->holderCity;
    }

    /**
     * @param Country $holderCountry
     */
    public function setHolderCountry(Country $holderCountry)
    {
        $this->holderCountry = $holderCountry;
    }

    /**
     * @return Country
     */
    public function getHolderCountry()
    {
        return $this->holderCountry;
    }

    /**
     * @param string $holderName
     */
    public function setHolderName($holderName)
    {
        $this->holderName = $holderName;
    }

    /**
     * @return string
     */
    public function getHolderName()
    {
        return $this->holderName;
    }
}
