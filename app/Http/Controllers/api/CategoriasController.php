<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorias;
use Illuminate\Support\Facades\DB;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = DB::table('categorias')
        ->orderBy('nombre_categoria')
        ->get();
        return json_encode(['categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categorias();
        $categoria->nombre_categoria = $request->nombre_categoria;    
        $categoria->descripción = $request->descripción;
        $categoria->save();
        return json_encode(['categoria'=>$categoria]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categorias::find($id);
        if(is_null($categoria)){
            return abort(404);
        }
        return json_encode(['categoria'=>$categoria]);
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
        $categoria = Categorias::find($id);
        $categoria->nombre_categoria = $request->nombre_categoria;    
        $categoria->descripción = $request->descripción;
        $categoria->save();
        return json_encode(['categoria'=>$categoria]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categorias::find($id);
        $categoria->delete();
        return json_encode(['success' => true]);
    }
}
