<?php

namespace ProjxIO\Token\Encoders;

use PHPUnit_Framework_TestCase;

class JsonEncoderTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $encoder = new JsonEncoder();
        $original = base64_encode(openssl_random_pseudo_bytes(1024));
        $encoded = $encoder->encode($original);
        $decoded = $encoder->decode($encoded);
        $this->assertNotEquals($original, $encoded);
        $this->assertEquals($original, $decoded);
    }
}
