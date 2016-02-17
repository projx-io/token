<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class Base64Encoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return base64_encode($value);
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return base64_decode($value);
    }
}
