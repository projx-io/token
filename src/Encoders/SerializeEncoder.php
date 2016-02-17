<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class SerializeEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return serialize($value);
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return unserialize($value);
    }
}
