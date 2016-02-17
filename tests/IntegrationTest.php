<?php

namespace ProjxIO\Token\Encoders;

use PHPUnit_Framework_TestCase;
use ProjxIO\Token\PackEncoderBuilder;

class IntegrationTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $key = openssl_random_pseudo_bytes(32);

        $max16 = 65535;
        $max32 = 4294967295;
        $max64 = 9223372036854775807;

        $original = [
            chr($i = ord('a')) => rand(0, $max64),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max64),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max64),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max64),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max16),
        ];

        $encoder = new CompositeEncoder([
            (new PackEncoderBuilder())
                ->uint64BE(chr($i = ord('a')))
                ->uint32BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint64BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint64BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint64BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint16BE(chr($i++))
                ->build(),
            new GZipInflateEncoder(),
            new RandomVectorOpenSSLEncoder($key),
            new Base64Encoder(),
        ]);

        $token = $encoder->encode($original);
        $decoded = $encoder->decode($token);

        $this->assertNotEquals($original, $token);
        $this->assertEquals($original, $decoded);
    }
}
