<?php

namespace ProjxIO\Token\Validation\Filters;

use ProjxIO\Token\Validation\ValidationFilter;

class IsStringFilter implements ValidationFilter
{
    /**
     * @inheritdoc
     */
    public function filter($value)
    {
        return is_string($value);
    }
}
