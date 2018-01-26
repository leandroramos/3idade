<?php

namespace App\Http\Controllers;

use App\Professor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProfessorController extends Controller
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
        $professores = Professor::all();

        return View::make('professores.index')
            ->with('professores', $professores);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect('professores/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $professor = new Professor;
        $professor->nome = $request->nome;
        
        $professor->save();
        return redirect()->route('professores.index')->with('message', 'Professor criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $professor = Professor::findOrFail($id);
        return view('professores.edit',compact('professor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required'
        ]);
        
        if ($validator->fails()) {
            return redirect('professores/{id}/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        //
        $professor = Professor::findOrFail($id);
        $professor = new Professor;
        $professor->nome = $request->nome;
        $professor->save();
        return redirect()->route('professores.index')->with('message', 'Professor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $professor = Professor::findOrFail($id);
        $professor->delete();
        return redirect()->route('professores.index')->with('alert-success','Professor deletado!');
    }
}
