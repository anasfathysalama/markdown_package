<?php

namespace Anas\Markdown\Fields;

class Extra implements AbstractField
{

    public static function process($filed, $value , $data)
    {

        $extraData = isset($data['extra']) ? (array)json_decode($data['extra']) : [] ;

       return [
          'extra' => json_encode(array_merge($extraData , [
             $filed => $value
          ]))
       ];
    }
}