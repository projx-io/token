<?php

namespace ProjxIO\Token;

class OnEncode implements Encoder
{
    /**
     * @var EncodeBehavior
     */
    private $behavior;

    /**
     * @param EncodeBehavior $behavior
     */
    public function __construct(EncodeBehavior $behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * @inheritDoc
     */
    public function decode($value)
    {
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function encode($value)
    {
        return $this->behavior->encode($value);
    }
}
