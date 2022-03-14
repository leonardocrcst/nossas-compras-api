<?php

namespace App\Http\Controllers\Responses;

class UnUpdate extends Responses
{
    public function __construct(string $resource)
    {
        parent::__construct("Não foi possível atualizar as informações do(a) $resource.", 422);
    }
}
