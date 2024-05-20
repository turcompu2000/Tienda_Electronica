<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Ventas;


class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $ventas = DB::table('ventas')
        ->join('productos', 'ventas.id_producto', '=','productos.id_producto')
        ->join('clientes', 'ventas.id_cliente', '=','clientes.id_cliente')
        ->select('ventas.*',"productos.nombre_producto","clientes.nombre_cliente")
        ->get();
        return json_encode(['ventas'=>$ventas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta = new Ventas();
        $venta->id_producto = $request->id_producto;    
        $venta->id_cliente = $request->id_cliente;
        $venta->cantidad = $request->cantidad;
        $venta->fecha_venta = $request->fecha_venta;
        $venta->total = $request->total;
        $venta->save();
        return json_encode(['venta'=>$venta]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venta = Ventas::find($id);
        $productos = DB::table('productos')
        ->orderBy('nombre_producto')
        ->get();
        $clientes = DB::table('clientes')
        ->orderBy('nombre_cliente')
        ->get();
        return json_encode(['venta'=>$venta, 'productos'=> $productos, 'clientes'=>$clientes]);
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
        $venta = Ventas::find($id);
        $venta->id_producto = $request->id_producto;    
        $venta->id_cliente = $request->id_cliente;
        $venta->cantidad = $request->cantidad;
        $venta->fecha_venta = $request->fecha_venta;
        $venta->total = $request->total;
        $venta->save();
        return json_encode(['venta'=>$venta]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Venta = Ventas::find($id);
        $Venta->delete();
        $ventas = DB::table('ventas')
        ->join('productos', 'ventas.id_producto', '=','productos.id_producto')
        ->join('clientes', 'ventas.id_cliente', '=','clientes.id_cliente')
        ->select('ventas.*',"productos.nombre_producto","clientes.nombre_cliente")
        ->get();
        return json_encode(['ventas' => $ventas, 'success' => true]);
    }
}
