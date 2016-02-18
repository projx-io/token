<?php

namespace ProjxIO\Token;

use PHPUnit_Framework_TestCase;
use ProjxIO\Token\DefuseCrypto\CryptoEncoder;

class CryptoEncoderTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $key = openssl_random_pseudo_bytes(16);
        $encoder = new CryptoEncoder($key);
        $original = openssl_random_pseudo_bytes(1024);
        $encoded = $encoder->encodeToken($original);
        $decoded = $encoder->decodeToken($encoded);
        $this->assertNotEquals($original, $encoded);
        $this->assertEquals($original, $decoded);
    }
}
