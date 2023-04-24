<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GastoController extends Controller
{
    public function index(){
        $gastos = Gasto::with('usuario:id,name')->paginate(10);
        return view('gastos.plantilla',compact('gastos'));
    }
    public function create(){
        return view('gastos.plantilla');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'concepto' => 'required',
            'fecha' => 'required',
            'monto' => 'required'
        ]);
        $saldo = Caja::saldo();

        if($saldo>=$request->monto){
            $caja=new Caja();
            $caja->fecha=now();
            $caja->id_usuario = Auth::user()->id;
            $caja->tipo = 'SALIDA';
            $caja->monto = $request->monto;
            $caja->saldo = $saldo - $request->monto;
            $caja->descripcion = 'GASTO';
            $caja->save();

            $gasto=new Gasto();
            $gasto->id_usuario=Auth::user()->id;
            $gasto->concepto=$request->concepto;
            $gasto->fecha=$request->fecha;
            $gasto->monto=$request->monto;
            $gasto->save();



            $request->session()->flash('success', 'Los datos se han guardado exitosamente.');
        }else{
            $request->session()->flash('error', 'No dispones de saldo en Caja');
        }
        return redirect()->route('gastos.create');
    }
    public function edit(Gasto $gasto){
        return view('prestamos.plantilla', compact('gasto'));
    }
    public function update(Gasto $gasto, Request $request){
        $gasto->concepto=$request->concepto;
        $gasto->fecha=$request->fecha;
        $gasto->monto=$request->monto;
        $gasto->save();
        $request->session()->flash('success', 'Los datos se han guardado exitosamente.');
        return redirect()->route('gastos.index');
    }
    public function destroy(Gasto $gasto){
        $gasto->delete();
        return redirect()->route('gastos.index');
    }
    public function cargarlista(Request $request){
        $descripcion = $request->descripcion;
        $gastos = Gasto::with('usuario:id,name')->where('concepto', 'like', '%'.$descripcion.'%')->paginate(10);
        $vista = view('gastos.tabla', compact('gastos'))->render();
        return response()->json(['html' => $vista]);
    }
}
