<?php

namespace App\Http\Controllers\Responses;

class UnTrashed extends Responses
{
    public function __construct(string $resource)
    {
        parent::__construct("Não foi possível remover o(a) $resource.", 405);
    }
}
