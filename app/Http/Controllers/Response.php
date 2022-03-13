<?php

namespace App\Http\Controllers;

class Response extends \Illuminate\Http\Response
{
    public function __construct($content = '', $status = 200, array $headers = [])
    {
        $default = [
            "Content-Type" => "application/json"
        ];
        parent::__construct("{\"message\":\"$content\"", $status, array_merge($default, $headers));
    }
}
