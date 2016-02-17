<?php

namespace ProjxIO\Token;

class DumpValue implements Encoder
{
    /**
     * @param mixed $value
     * @return string
     * @throws EncodeException
     */
    public function encodeToken($value)
    {
        var_dump($value);
        return $value;
    }

    /**
     * @param string $value
     * @return mixed
     * @throws DecodeException
     */
    public function decodeToken($value)
    {
        var_dump($value);
        return $value;
    }
}
