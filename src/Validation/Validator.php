<?php

namespace ProjxIO\Token\Validation;

use ProjxIO\Token\DecodeException;
use ProjxIO\Token\EncodeBehavior;
use ProjxIO\Token\EncodeException;

class Validator implements EncodeBehavior
{
    /**
     * @var Validation[]
     */
    private $validations;

    /**
     * @param Validation[] $validations
     */
    public function __construct($validations = [])
    {
        $this->validations = $validations;
    }

    /**
     * @inheritDoc
     */
    public function encodeToken($value)
    {
        foreach($this->validations as $validation) {
            if (!$validation->validate($value)) {
                throw new EncodeException($validation->message($value));
            }
        }

        return $value;
    }

    /**
     * @inheritDoc
     */
    public function decodeToken($value)
    {
        foreach($this->validations as $validation) {
            if (!$validation->validate($value)) {
                throw new DecodeException($validation->message($value));
            }
        }

        return $value;
    }
}
