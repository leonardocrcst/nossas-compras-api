<?php

namespace App\Http\Controllers\Responses;

class Created extends Responses
{
    public function __construct(string $resource)
    {
        parent::__construct("$resource criado(a) com sucesso!", 201);
    }
}
