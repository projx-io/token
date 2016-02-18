<?php

namespace ProjxIO\Token;

use PHPUnit_Framework_TestCase;

class SerializeEncoderTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $encoder = new SerializeEncoder();
        $original = openssl_random_pseudo_bytes(1024);
        $encoded = $encoder->encodeToken($original);
        $decoded = $encoder->decodeToken($encoded);
        $this->assertNotEquals($original, $encoded);
        $this->assertEquals($original, $decoded);
    }
}
