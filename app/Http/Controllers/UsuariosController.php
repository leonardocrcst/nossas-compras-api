<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Throwable;

class UsuariosController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return parent::getCreate(new Usuarios());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $model = new Usuarios();
        foreach($request->json() as $field => $value) {
            if("password" === $field) {
                $value = password_hash($value, CRYPT_BLOWFISH);
            }
            $model->$field = $value;
        }
        try {
            $model->saveOrFail();
            return new Response("Sucesso!", 201);
        } catch (Throwable $exception) {
            return new Response($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Usuarios $usuarios
     * @return Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Usuarios $usuarios
     * @return Response
     */
    public function edit(Usuarios $usuarios)
    {
        return $this->getCreate($usuarios);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Usuarios $usuarios
     * @return Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Usuarios $usuarios
     * @return Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
