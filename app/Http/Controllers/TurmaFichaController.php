<?php

namespace App\Http\Controllers;

use App\TurmaFicha;
use Illuminate\Http\Request;

class TurmaFichaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TurmaFicha  $turmaFicha
     * @return \Illuminate\Http\Response
     */
    public function show(TurmaFicha $turmaFicha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TurmaFicha  $turmaFicha
     * @return \Illuminate\Http\Response
     */
    public function edit(TurmaFicha $turmaFicha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TurmaFicha  $turmaFicha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TurmaFicha $turmaFicha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TurmaFicha  $turmaFicha
     * @return \Illuminate\Http\Response
     */
    public function destroy(TurmaFicha $turmaFicha)
    {
        //
    }
}
