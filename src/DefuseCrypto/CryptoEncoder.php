<?php

namespace ProjxIO\Token\DefuseCrypto;

use Defuse\Crypto\Crypto;
use ProjxIO\Token\Encoder;

class CryptoEncoder implements Encoder
{
    /**
     * @var
     */
    private $key;

    /**
     * CryptoEncoder constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return Crypto::Encrypt($value, $this->key);
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        return Crypto::Decrypt($value, $this->key);
    }
}
