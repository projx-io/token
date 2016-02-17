<?php

namespace ProjxIO\Token\Validation\Filters;

use ProjxIO\Token\Validation\ValidationFilter;

class IsArrayFilter implements ValidationFilter
{
    /**
     * @inheritdoc
     */
    public function filter($value)
    {
        return is_array($value);
    }
}
