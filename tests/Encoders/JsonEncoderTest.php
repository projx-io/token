<?php

namespace ProjxIO\Token;

use PHPUnit_Framework_TestCase;

class JsonEncoderTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $encoder = new JsonEncoder();
        $original = base64_encode(openssl_random_pseudo_bytes(1024));
        $encoded = $encoder->encodeToken($original);
        $decoded = $encoder->decodeToken($encoded);
        $this->assertNotEquals($original, $encoded);
        $this->assertEquals($original, $decoded);
    }
}
