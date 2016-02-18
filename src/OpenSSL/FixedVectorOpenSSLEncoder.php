<?php

namespace ProjxIO\Token\OpenSSL;

class FixedVectorOpenSSLEncoder extends OpenSSLEncoder
{
    /**
     * @var string
     */
    private $vector;

    /**
     * @param string $key
     * @param string $vector
     * @param string $method
     * @param int $flags
     */
    public function __construct($key, $vector, $method = 'aes-256-cbc', $flags = OPENSSL_RAW_DATA)
    {
        parent::__construct($key, $method, $flags);
        $this->vector = $vector;
    }

    public function encodingVector()
    {
        return $this->vector;
    }

    public function decodingVector($token)
    {
        return $this->vector;
    }

    public function encoded($token, $value, $method, $key, $flags, $vector)
    {
        return $token;
    }

    public function decodingValue($token)
    {
        return $token;
    }

    public function decoded($value, $token, $method, $key, $flags, $vector)
    {
        return $value;
    }
}
