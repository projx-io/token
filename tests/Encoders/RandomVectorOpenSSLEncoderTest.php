<?php

namespace ProjxIO\Token\Encoders;

use PHPUnit_Framework_TestCase;
use ProjxIO\Token\Encoders\OpenSSL\RandomVectorOpenSSLEncoder;

class RandomVectorOpenSSLEncoderTest extends PHPUnit_Framework_TestCase
{
    public function testAES()
    {
        $key = base64_encode(openssl_random_pseudo_bytes(1024));
        $encoder = new RandomVectorOpenSSLEncoder($key);
        $original = openssl_random_pseudo_bytes(1024);
        $encoded = $encoder->encodeToken($original);
        $decoded = $encoder->decodeToken($encoded);
        $this->assertNotEquals($original, $encoded);
        $this->assertEquals($original, $decoded);
    }
}
