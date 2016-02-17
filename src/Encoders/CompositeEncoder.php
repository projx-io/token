<?php

namespace ProjxIO\Token\Encoders;

use ProjxIO\Token\Encoder;

class CompositeEncoder implements Encoder
{
    /**
     * @var Encoder[]
     */
    private $encoders;

    /**
     * @param Encoder[] $encoders
     */
    public function __construct($encoders = [])
    {
        $this->encoders = $encoders;
    }

    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        foreach ($this->encoders as $encoder) {
            $value = $encoder->encodeToken($value);
        }
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        foreach (array_reverse($this->encoders) as $encoder) {
            $value = $encoder->decode($value);
        }
        return $value;
    }
}
