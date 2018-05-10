<?php

namespace App\Http\Controllers;

use App\Declaracion;
use App\User;
use App\Formula;
use Illuminate\Http\Request;

class DeclaracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $declaraciones = Declaracion::simplePaginate(5);
        return view('declaracion.lista')->with(['declaraciones' => $declaraciones]);
    }

    public function indexDec(){
        //$declaraciones = Declaracion::all();
        //$users = User::all();
        //return view('listado', compact('declaraciones','users'));
        return view('listado');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->notDefined();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$data = $request->validate([
            'periodo' => 'required',
        ]);*/

        $declaracion = Declaracion::create($request->all());

        return $this->creationMessage();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Declaracion  $declaracion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $declaracion = Declaracion::findOrFail($id);
        return $declaracion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Declaracion  $declaracion
     * @return \Illuminate\Http\Response
     */
    public function edit(Declaracion $declaracion)
    {
        return view('declaracion.formulario')->with(['id' => $declaracion->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Declaracion  $declaracion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Declaracion $declaracion)
    {
        /*$data = $request->validate([
            'periodo' => 'required',
        ]);*/

        //$data->merge(['id_usuario' => Auth::user()->id]);

        $declaracion->fill($request->all());
        $declaracion->save();

        return $this->updateMessage();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Declaracion  $declaracion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Declaracion $declaracion)
    {
        $declaracion->delete();

        return $this->deleteMessage();
    }
}
