<?php

namespace ProjxIO\Token\Validation;

use ProjxIO\Token\Encoder;

class EncoderValidator implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return $value;
    }
}
