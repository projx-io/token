<?php

namespace ProjxIO\Token\Encoders;

use PHPUnit_Framework_TestCase;
use ProjxIO\Token\Encoders\Pack\PackEncoderBuilder;

class PackEncoderTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $original = [
            'c' => 67,
            'd' => 68,
            'a' => 65,
            'b' => 66,
        ];
        $encoder = (new PackEncoderBuilder())
                ->uint32BE('c')
                ->uint32LE('d')
                ->uint16BE('a')
                ->uint16LE('b')
                ->build();
        $encoded = $encoder->encodeToken(array_values($original));
        $decoded = $encoder->decodeToken($encoded);
        $this->assertNotEquals($original, $encoded);
        $this->assertEquals($original, $decoded);
    }
}
