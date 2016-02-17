<?php

namespace ProjxIO\Token;

interface EncodeBehavior
{
    /**
     * @param mixed $value
     * @return string
     * @throws EncodeException
     */
    public function encodeToken($value);
}
