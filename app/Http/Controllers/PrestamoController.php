<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class PrestamoController extends Controller
{
    public function index(){
        $data['prestamos'] = Prestamo::with(['cliente:id,apellidos,nombres,dni', 'usuario:id,name'])->orderBy('fecha', 'desc')->paginate(5);
        //$data['contenido']='prestamos.inicio';
        return view('prestamos.plantilla', $data);
    }

    public function create(){
        //$data['contenido']='prestamos.create';
        return view('prestamos.plantilla');
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'dni'   => 'required|max:8',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha' => 'required|date',
            'fechavencimiento' => 'required|date',
            'monto' => 'required|numeric',
            'tasa' => 'required|numeric',
            'frecuencia' => 'required',
            'periodo' => 'required',
            'cuota' => 'required|numeric',
            'zona' => 'required|string|max:255',
        ]);

        $verificar = Cliente::where('dni', $request->dni)->first();
        if(!$verificar){
            $cliente = new Cliente();
        }else{
            $cliente = $verificar->first();
        }

        $cliente->dni=$request->dni;
        $cliente->apellidos=$request->apellidos;
        $cliente->nombres=$request->nombres;
        $cliente->direccionCasa=$request->direccionCasa;
        $cliente->direccionCobro=$request->direccionCobro;
        $cliente->telefono=$request->telefono;
        $cliente->telefonoContacto=$request->telefonoContacto;
        $cliente->save();

        $prestamo = new Prestamo();
        $prestamo->id_cliente = $cliente->id;
        $prestamo->id_usuario = Auth::user()->id;
        $prestamo->fecha = $request->fecha;
        $prestamo->fechavencimiento = $request->input('fechavencimiento');
        $prestamo->monto = $request->monto;
        $prestamo->tasa = $request->tasa;
        $prestamo->cuota = $request->cuota;
        $prestamo->total = $request->total;
        $prestamo->frecuencia = $request->frecuencia;
        $prestamo->periodo = $request->periodo;
        $prestamo->saldo = $prestamo->total;
        $prestamo->zona = $request->zona;
        $prestamo->save();
        $request->session()->flash('success', 'Los datos se han guardado exitosamente.');

        return redirect()->route('prestamos.create');
    }
    public function show(Prestamo $prestamo){
        $prestamo = Prestamo::with('cliente:id,dni,nombres,apellidos')->find($prestamo->id);
        //return view('prestamos.show', compact('prestamo'));
        $vista = view('prestamos.show', compact('prestamo'))->render();
        return response()->json(['html' => $vista]);
    }
    public function destroy(Prestamo $prestamo){
        $prestamo->delete();
        return redirect()->route('prestamos.index');
    }
    public function edit(Prestamo $prestamo){
        $vista = view('prestamos.edit', compact('prestamo'))->render();
        return response()->json(['html' => $vista]);
    }
    public function update(Request $request, Prestamo $prestamo){

        $validatedData = $request->validate([
            'dni'   => 'required|max:8',
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'fecha' => 'required|date',
            'fechavencimiento' => 'required|date',
            'monto' => 'required|numeric',
            'tasa' => 'required|numeric',
            'frecuencia' => 'required',
            'periodo' => 'required',
            'cuota' => 'required|numeric',
            'zona' => 'required|string|max:255',
        ]);

        $verificar = Cliente::where('dni', $request->dni)->first();
        if(!$verificar){
            $cliente = new Cliente();
        }else{
            $cliente = $verificar->first();
        }

        $cliente->dni=$request->dni;
        $cliente->apellidos=$request->apellidos;
        $cliente->nombres=$request->nombres;
        $cliente->direccionCasa=$request->direccionCasa;
        $cliente->direccionCobro=$request->direccionCobro;
        $cliente->telefono=$request->telefono;
        $cliente->telefonoContacto=$request->telefonoContacto;
        $cliente->save();

        $prestamo->id_cliente = $cliente->id;
        $prestamo->id_usuario = Auth::user()->id;
        $prestamo->fecha = $request->fecha;
        $prestamo->fechavencimiento = $request->input('fechavencimiento');
        $prestamo->monto = $request->monto;
        $prestamo->tasa = $request->tasa;
        $prestamo->cuota = $request->cuota;
        $prestamo->total = $request->total;
        $prestamo->frecuencia = $request->frecuencia;
        $prestamo->periodo = $request->periodo;
        $prestamo->saldo = $prestamo->total;
        $prestamo->zona = $request->zona;
        $prestamo->estado=$request->estado;
        $prestamo->save();
        $request->session()->flash('success', 'Los datos se han actualizaron exitosamente.');
        return redirect()->route('prestamos.index');

    }
}
