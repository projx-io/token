<?php

namespace ProjxIO\Token;

class DumpValue implements Encoder
{
    /**
     * @param mixed $value
     * @return string
     * @throws EncodeException
     */
    public function encode($value)
    {
        var_dump($value);
        return $value;
    }

    /**
     * @param string $value
     * @return mixed
     * @throws DecodeException
     */
    public function decode($value)
    {
        var_dump($value);
        return $value;
    }
}
