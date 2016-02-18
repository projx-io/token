<?php

namespace ProjxIO\Token;

use ProjxIO\Token\Encoder;

class SerializeEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return serialize($value);
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return unserialize($value);
    }
}
