<?php

namespace ProjxIO\Token\Validation;

use ProjxIO\Token\Encoder;

class EncoderValidator implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encode($value)
    {
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return $value;
    }
}
