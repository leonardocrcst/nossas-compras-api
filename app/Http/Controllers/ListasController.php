<?php

namespace App\Http\Controllers;

use App\Models\Listas;
use App\Http\Requests\StoreListasRequest;
use App\Http\Requests\UpdateListasRequest;

class ListasController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreListasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListasRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Listas  $listas
     * @return \Illuminate\Http\Response
     */
    public function show(Listas $listas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Listas  $listas
     * @return \Illuminate\Http\Response
     */
    public function edit(Listas $listas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateListasRequest  $request
     * @param  \App\Models\Listas  $listas
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateListasRequest $request, Listas $listas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Listas  $listas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listas $listas)
    {
        //
    }
}
