<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Declaracion;
use App\Rango;
use PDF;

class HomeController extends Controller
{
    /**
     * 
     *
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('spa');
    }

    public function pdf($id)
    {
        $declaracion = Declaracion::findOrFail($id)->load(['usuario.departamento.facultad','usuario.jornada', 'usuario.jerarquia']);
        $rangos = Rango::all();
        $data = [
            'declaracion' => $declaracion,
            'rangos' => $rangos
        ];
        //dd($data["declaracion"]);
        //return view('pdf.vista', compact(['data']));
        $pdf = PDF::loadView('pdf.vista', compact(['data']))
                ->setPaper('a4', 'landscape');
        return $pdf->inline();
        //return $pdf->download('resumen.pdf');
    }
}
