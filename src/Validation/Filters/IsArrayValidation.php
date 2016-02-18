<?php

namespace ProjxIO\Token\Validation\Filters;

use ProjxIO\Token\Validation\Validation;

class IsArrayValidation implements Validation
{
    /**
     * @inheritdoc
     */
    public function validate($value)
    {
        return is_array($value);
    }

    /**
     * @inheritdoc
     */
    public function message($value)
    {
        return 'expected array';
    }
}
