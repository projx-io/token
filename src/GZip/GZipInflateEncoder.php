<?php

namespace ProjxIO\Token\GZip;

use ProjxIO\Token\Encoder;

class GZipInflateEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return gzdeflate($value, 1);
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return gzinflate($value);
    }
}
