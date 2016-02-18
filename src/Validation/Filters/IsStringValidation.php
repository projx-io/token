<?php

namespace ProjxIO\Token\Validation\Filters;

use ProjxIO\Token\Validation\Validation;

class IsStringValidation implements Validation
{
    /**
     * @inheritdoc
     */
    public function validate($value)
    {
        return is_string($value);
    }

    /**
     * @inheritdoc
     */
    public function message($value)
    {
        return 'expected string';
    }
}
