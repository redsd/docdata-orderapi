<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
abstract class AbstractRequestError extends AbstractObject
{
    /**
     * @var Error
     */
    protected $error;

    /**
     * @param Error $error
     */
    public function setError(Error $error)
    {
        $this->error = $error;
    }

    /**
     * @return Error
     */
    public function getError()
    {
        return $this->error;
    }
}
