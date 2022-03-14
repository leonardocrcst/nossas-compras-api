<?php

namespace App\Http\Controllers\Responses;

class Unknown extends Responses
{
    public function __construct(string $resource)
    {
        parent::__construct("$resource não encontrado(a)", 404);
    }
}
