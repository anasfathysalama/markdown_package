<?php

namespace Anas\Markdown;

use Parsedown;

class MarkdownParser
{

    public static function parse($string)
    {
        return Parsedown::instance()->text($string);
    }

}