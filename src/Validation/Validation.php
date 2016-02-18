<?php

namespace ProjxIO\Token\Validation;

use ProjxIO\Token\DecodeException;
use ProjxIO\Token\EncodeException;

interface Validation
{
    /**
     * @param mixed $value
     * @return string
     */
    public function message($value);

    /**
     * @param mixed $value
     * @return boolean
     */
    public function validate($value);
}
