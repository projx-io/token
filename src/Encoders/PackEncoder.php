<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class PackEncoder implements Encoder
{
    /**
     * @var array
     */
    private $structure;

    /**
     * @param array $structure
     */
    public function __construct($structure = [])
    {
        $this->structure = $structure;
    }

    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        $args = array_merge([implode('', $this->structure)], $value);
        return call_user_func_array('pack', $args);
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        $unpack = implode('/', array_map(function ($type, $key) {
            return $type . $key;
        }, $this->structure, array_keys($this->structure)));
        return unpack($unpack, $value);
    }
}
