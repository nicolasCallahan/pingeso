<?php

namespace App\Http\Controllers;

use App\Facultad;
use App\Comision;
use Illuminate\Http\Request;
use Validator;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Facultad::all()->load('departamentos');
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
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }
        $comision = new Comision;
        $comision->tipo = 3;
        $comision->save();
        $facultad = new Facultad($request->all());
        $facultad->id_comision = $comision->id;
        $facultad->save();

        return $facultad;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facultad = Facultad::findOrFail($id);
        return $facultad;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->notDefined();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $facultad = Facultad::findOrFail($id);
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
           return response()->json($validator->errors(), 422);
        }

        $facultad->fill($request->all());
        $facultad->save();

        return $facultad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Facultad  $facultad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facultad = Facultad::findOrFail($id);
        $facultad->delete();

        return $this->deleteMessage();
    }

    protected function rules()
    {
        return [
            'nombre' => 'required'
        ];
    }
}
