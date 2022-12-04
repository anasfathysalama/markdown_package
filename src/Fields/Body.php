<?php

namespace Anas\Markdown\Fields;

class Body implements AbstractField
{

    public static function process($filed, $value , $data)
    {
        return [
            $filed => $value
        ];
    }
}