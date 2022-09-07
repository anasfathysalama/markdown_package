<?php

namespace Anas\Markdown\Fields;

use Carbon\Carbon;

class Date implements AbstractField
{

    public static function process($field, $value)
    {
        return [
            $field => Carbon::parse($value)
        ];
    }

}