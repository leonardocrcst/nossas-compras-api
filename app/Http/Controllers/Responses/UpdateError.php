<?php

namespace App\Http\Controllers\Responses;

class UpdateError extends Responses
{
    public function __construct(string $resource, string $code, array $response)
    {
        parent::__construct("Ocorreu um erro ao atualizar as informações do(a) $resource. Código do erro: $code.", 409, $response);
    }
}
