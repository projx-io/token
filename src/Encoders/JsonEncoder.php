<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class JsonEncoder implements Encoder
{
    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return json_encode($value);
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return json_decode($value);
    }
}
