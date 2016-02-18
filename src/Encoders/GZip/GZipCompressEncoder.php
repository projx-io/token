<?php

namespace ProjxIO\Token\Encoders\GZip;

use ProjxIO\Token\Encoder;

class GZipCompressEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return gzcompress($value, 9);
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return gzuncompress($value);
    }
}
