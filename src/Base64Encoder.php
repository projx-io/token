<?php

namespace ProjxIO\Token;

use ProjxIO\Token\Encoder;

class Base64Encoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return base64_encode($value);
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return base64_decode($value);
    }
}
