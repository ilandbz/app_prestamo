<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Prestamo;
use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PagoController extends Controller
{
    public function index(){
        if(session('tipo_usuario')=='Cliente'){
            $dni = session('dni');
            $pagos = Pago::with(['usuario:id,name', 'prestamo:id,saldo,id_cliente', 'prestamo.cliente:id,apellidos,nombres,dni'])
            // ->where('prestamo.cliente.dni', session('dni'))->paginate(10);
            ->where(function($query) use($dni) {
                $query->WhereHas('prestamo.cliente',function($q) use($dni){
                        $q->where('dni', $dni);
                    });
            })
            ->paginate(10);

        }else{
            $pagos = Pago::with(['usuario:id,name', 'prestamo:id,saldo,id_cliente', 'prestamo.cliente:id,apellidos,nombres'])->paginate(10);
        }
        return view('prestamos.plantilla',compact('pagos'));
    }
    public function create(Prestamo $prestamo){
        $prestamo = Prestamo::with('cliente:id,dni,nombres,apellidos')->find($prestamo->id);
        return view('prestamos.plantilla', compact('prestamo'));
    }
    public function store(Request $request){
        // return $request;
        $validatedData = $request->validate([
            'id_prestamo' => 'required|numeric',
            'fecha' => 'required|date',
            'monto' => 'required|numeric',
        ]);
        $saldo = Caja::saldo();
        $prestamo = Prestamo::find($request->id_prestamo);
        $prestamo->saldo=$prestamo->saldo-$request->monto;
        $prestamo->estado=$prestamo->saldo <= 0 ? 0 : 1;
        $prestamo->save();

        $caja=new Caja();
        $caja->fecha=now();
        $caja->id_usuario = Auth::user()->id;
        $caja->tipo = 'SALIDA';
        $caja->monto = $request->monto;
        $caja->saldo = $saldo + $request->monto;
        $caja->descripcion = 'PAGO';
        $caja->save();


        $pago=new Pago();
        $pago->id_usuario=Auth::user()->id;
        $pago->id_prestamo=$request->id_prestamo;
        $pago->fecha=$request->fecha;
        $pago->monto=$request->monto;
        $pago->save();

        $request->session()->flash('success', 'Los datos se han guardado exitosamente.');

        return redirect()->route('pagos.create', $pago->id_prestamo);
    }
    public function update(){

    }
    public function destroy(){

    }
    public function cargarpagos(Request $request){
        $pagos = Pago::with(['usuario:id,name', 'prestamo:id,saldo,id_cliente', 'prestamo.cliente:id,apellidos,nombres'])->where('fecha', 'like', $request->fecha.'%')->paginate(10);
        $vista = view('prestamos.tablapagos', compact('pagos'))->render();
        return response()->json(['html' => $vista]);
    }
}
