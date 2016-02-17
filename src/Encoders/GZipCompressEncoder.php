<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class GZipCompressEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return gzcompress($value, 9);
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return gzuncompress($value);
    }
}
