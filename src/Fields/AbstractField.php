<?php

namespace Anas\Markdown\Fields;

interface AbstractField
{
     public static function process($filed, $value , $data);
}