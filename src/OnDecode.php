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
    public function decodeToken($value)
    {
        return $this->behavior->decodeToken($value);
    }

    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        return $value;
    }
}
