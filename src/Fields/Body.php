<?php

namespace Anas\Markdown\Fields;

use Anas\Markdown\MarkdownParser;

class Body implements AbstractField
{

    public static function process($filed, $value)
    {
        return [
            $filed => $value
        ];
    }
}