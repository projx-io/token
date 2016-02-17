<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class JsonEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return json_encode($value);
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return json_decode($value);
    }
}
