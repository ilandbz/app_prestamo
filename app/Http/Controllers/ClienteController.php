<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index(){
        return view('prestamos.plantilla');
    }
    public function create(){

    }
    public function store(){

    }
    public function update(){

    }
    public function destroy(){

    }
    public function obtenerdatos(Request $request){
        $cliente = Cliente::where('dni', $request->dni)->first();
        if ($cliente) {
            return response()->json(['success' => true, 'cliente' => $cliente]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cliente no encontrado']);
        }
    }
}
