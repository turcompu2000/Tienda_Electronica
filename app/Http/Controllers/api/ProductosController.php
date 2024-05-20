<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = DB::table('productos')
        ->join('categorias', 'productos.id_categoria', '=','categorias.id_categoria')
        ->select('productos.*',"categorias.nombre_categoria")
        ->get();
    return json_encode(['productos'=>$productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validate = Validator::make($request->all(),[
            'nombre_producto' => ['required','max:30','unique'],
            'descripción' => ['required','max:100','unique'],
            'precio' => ['required','numeric'],
            'stock' => ['required','numeric'],
            'id_categoria' => ['required','numeric','min:1']
        ]);

        if($validate->fails()){
            return response()->json([
                'msg' => 'Se produjo un error en la validacion de la informacion.',
                'statusCode' => 400
            ]);
        }*/

        $producto = new Productos();
        $producto->nombre_producto = $request->nombre_producto;    
        $producto->descripción = $request->descripción;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->id_categoria = $request->id_categoria;
        $producto->save();
        return json_encode(['producto'=>$producto]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Productos::find($id);
        if(is_null($producto)){
            return abort(404);
        }
        $categorias = DB::table('categorias')
        ->orderBy('nombre_categoria')
        ->get();
        return json_encode(['producto'=>$producto, 'categorias'=> $categorias]);
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
        $producto = Productos::find($id);
        $producto->nombre_producto = $request->nombre_producto;    
        $producto->descripción = $request->descripción;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->id_categoria = $request->id_categoria;
        $producto->save();
        return json_encode(['producto'=>$producto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Productos::find($id);
        $producto->delete();
        $productos = DB::table('productos')
        ->join('categorias', 'productos.categoria_id', '=','categorias.id_categoria')
        ->select('productos.*',"categorias.nombre_categoria")
        ->get();
        return json_encode(['productos' => $productos, 'success' => true]);
    }
}
