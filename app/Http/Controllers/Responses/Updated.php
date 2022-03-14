<?php

namespace App\Http\Controllers\Responses;

class Updated extends Responses
{
    public function __construct(string $resource)
    {
        parent::__construct("$resource atualizado(a) com sucesso!", 200);
    }
}
