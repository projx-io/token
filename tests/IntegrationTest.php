<?php

namespace ProjxIO\Token\Encoders;

use PHPUnit_Framework_TestCase;
use ProjxIO\Token\PackEncoderBuilder;

class IntegrationTest extends PHPUnit_Framework_TestCase
{
    public function testPHP_5_5_or_lower()
    {
        $key = openssl_random_pseudo_bytes(32);

        $max16 = 65535;
        $max32 = 4294967295;
        $max64 = 9223372036854775807;

        $original = [
            chr($i = ord('a')) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
        ];

        $encoder = new CompositeEncoder([
            (new PackEncoderBuilder())
                ->uint16BE(chr($i = ord('a')))
                ->uint32BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint32BE(chr($i++))
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

    public function testPHP_5_6_or_higher()
    {
        /**
         * 64bit options available only in version >= 5.6.3
         * @see http://php.net/manual/en/function.pack.php#refsect1-function.pack-changelog
         */
        if (version_compare(PHP_VERSION, '5.6.3') < 0) {
            return;
        }

        $key = openssl_random_pseudo_bytes(32);

        $max16 = 65535;
        $max32 = 4294967295;
        $max64 = 9223372036854775807;

        $original = [
            chr($i = ord('a')) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max64),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max64),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max64),
            chr($i++) => rand(0, $max16),
            chr($i++) => rand(0, $max32),
            chr($i++) => rand(0, $max64),
        ];

        $encoder = new CompositeEncoder([
            (new PackEncoderBuilder())
                ->uint16BE(chr($i = ord('a')))
                ->uint32BE(chr($i++))
                ->uint64BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint64BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint64BE(chr($i++))
                ->uint16BE(chr($i++))
                ->uint32BE(chr($i++))
                ->uint64BE(chr($i++))
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
