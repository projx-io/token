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
    public function encode($value)
    {
        foreach ($this->encoders as $encoder) {
            $value = $encoder->encode($value);
        }
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        foreach (array_reverse($this->encoders) as $encoder) {
            $value = $encoder->decode($value);
        }
        return $value;
    }
}
