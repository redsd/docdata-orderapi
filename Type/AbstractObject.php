<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
abstract class AbstractObject implements TypeInterface
{
    /**
     * @return array
     */
    public function toArray()
    {
        $return = [];

        foreach ($this as $name => $value) {
            if ($value === null) {
                continue;
            }

            if ($value instanceof TypeInterface) {
                $data = $value->toArray();
            } else {
                $data = $value;
            }

            $return[$name] = $data;
        }

        return $return;
    }
}
