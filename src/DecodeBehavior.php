<?php

namespace ProjxIO\Token;

interface DecodeBehavior
{
    /**
     * @param string $value
     * @return mixed
     * @throws DecodeException
     */
    public function decodeToken($value);
}
