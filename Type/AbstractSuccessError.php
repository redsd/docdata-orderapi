<?php
namespace CL\DocData\Component\OrderApi\Type;

/**
 * DocDataPayments SuccessError class
 *
 * @author        Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class AbstractSuccessError extends AbstractObject
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var array
     */
    protected $explanations = [];

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get a decent explanation
     *
     * @return string
     */
    public function getExplanation()
    {
        $message = $this->explanations[$this->code];
        if (isset($this->_)) {
            $message .= ' ' . $this->_;
        }

        return $message;
    }
}
