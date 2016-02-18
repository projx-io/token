<?php

namespace ProjxIO\Token\GZip;

use ProjxIO\Token\Encoder;

class GZipEncodeEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return gzencode($value, 9);
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return gzdecode($value);
    }
}
