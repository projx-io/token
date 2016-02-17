<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class GZipEncodeEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return gzencode($value, 9);
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return gzdecode($value);
    }
}
