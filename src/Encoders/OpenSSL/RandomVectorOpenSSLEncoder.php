<?php

namespace ProjxIO\Token\Encoders\OpenSSL;

class RandomVectorOpenSSLEncoder extends OpenSSLEncoder
{
    /**
     * @param string $key
     * @param string $method
     * @param int $flags
     */
    public function __construct($key, $method = 'aes-256-cbc', $flags = OPENSSL_RAW_DATA)
    {
        parent::__construct($key, $method, $flags);
    }

    public function encodingVector()
    {
        return openssl_random_pseudo_bytes(14);
    }

    public function encoded($token, $value, $method, $key, $flags, $vector)
    {
        return $vector . $token;
    }

    public function decodingVector($token)
    {
        return substr($token, 0, 14);
    }

    public function decodingValue($token)
    {
        return substr($token, 14);
    }

    public function decoded($value, $token, $method, $key, $flags, $vector)
    {
        return $value;
    }
}
