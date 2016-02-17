<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class GZipInflateEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return gzdeflate($value, 1);
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return gzinflate($value);
    }
}
