<?php

namespace App\Http\Controllers\Responses;

class Trashed extends Responses
{
    public function __construct(string $resource)
    {
        parent::__construct("$resource removido(a) com sucesso!", 200);
    }
}
