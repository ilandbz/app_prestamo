<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cajaregistros = Caja::with('usuario:id,name')->orderBy('fecha', 'desc')->paginate(10);
        return view('caja.plantilla',compact('cajaregistros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caja $caja)
    {
        $caja->delete();
        return redirect()->route('caja.index');
    }
}
