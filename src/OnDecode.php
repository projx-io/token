<?php

namespace ProjxIO\Token;

class OnDecode implements Encoder
{
    /**
     * @var DecodeBehavior
     */
    private $behavior;

    /**
     * @param DecodeBehavior $behavior
     */
    public function __construct(DecodeBehavior $behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return $this->behavior->decode($value);
    }

    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return $value;
    }
}
