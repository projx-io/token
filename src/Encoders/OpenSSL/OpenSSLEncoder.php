<?php

namespace ProjxIO\Token\Encoders\OpenSSL;

use ProjxIO\Token\Encoder;

abstract class OpenSSLEncoder implements Encoder
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $key;

    /**
     * @var int
     */
    private $flags;

    /**
     * @param string $key
     * @param string $method
     * @param int $flags
     */
    public function __construct($key, $method = 'aes-256-cbc', $flags = OPENSSL_RAW_DATA)
    {
        $this->key = $key;
        $this->method = $method;
        $this->flags = $flags;
    }

    public function flags()
    {
        return $this->flags;
    }

    public function key()
    {
        return $this->key;
    }

    public function method()
    {
        return $this->method;
    }

    /**
     * @inheritdoc
     */
    public function encodeToken($value)
    {
        $method = $this->method();
        $key = $this->key();
        $flags = $this->flags();
        $vector = $this->encodingVector();
        $token = openssl_encrypt($value, $method, $key, $flags, $vector . ord(0x0));
        $token = $this->encoded($token, $value, $method, $key, $flags, $vector);
        return $token;
    }

    /**
     * @inheritdoc
     */
    public function decodeToken($token)
    {
        $method = $this->method();
        $key = $this->key();
        $flags = $this->flags();
        $vector = $this->decodingVector($token);
        $value = $this->decodingValue($token);
        $value = openssl_decrypt($value, $method, $key, $flags, $vector . ord(0x0));
        $value = $this->decoded($value, $token, $method, $key, $flags, $vector);
        return $value;
    }

    abstract public function encodingVector();

    abstract public function encoded($token, $value, $method, $key, $flags, $vector);

    abstract public function decodingVector($token);

    abstract public function decodingValue($token);

    abstract public function decoded($value, $token, $method, $key, $flags, $vector);
}
