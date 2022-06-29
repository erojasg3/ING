<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
class ProductoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|eliminar-producto', ['only'=>['index']]);
        $this->middleware('permission:crear-producto',['only'=>['create','store']]);
        $this->middleware('permission:editar-producto',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-producto',['only'=>['destroy']]);
        
    } /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::paginate(5);
        return view('productos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre_producto'=>'required|unique:productos,nombre_producto,',
            'descripcion'=>'required',
            'precio'=>'required',
            'stock'=>'required'
        ]);
        Producto::create($request->all());
        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        return view('productos.editar',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        request()->validate([
            'nombre_producto'=>'required',
            'precio'=>'required',
            'descripcion'=>'requiered',
            'stock'=>'requiered'
        ]);
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
