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
    public function decodeToken($value)
    {
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return $this->behavior->encodeToken($value);
    }
}
