<?php

namespace App\Http\Controllers\Responses;

class UnCreated extends Responses
{
    public function __construct(string $resource, $code, $extra = [])
    {
        $text = "Não foi possível registrar o(a) $resource.";
        if(!is_null($code)) {
            $text .= " Código do erro: $code.";
        }
        parent::__construct($text, 422, $extra);
    }
}
