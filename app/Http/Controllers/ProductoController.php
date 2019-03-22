<?php

namespace SportStore\Http\Controllers;

use SportStore\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productos = Producto::orderBy('id')->paginate(15);

        return view('admin.admin')
            ->with('productos', $productos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Producto::all()->pluck('categoria')->unique();
        return view('admin.productos.crear')
            ->with('categorias', $categorias);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarDatos($request);

        Producto::create(Input::all());

        $msg = 'El producto se ha creado satisfactoriamente';
        \Utils::enviarMensaje('Éxito', 'success', $msg);

        return redirect()->route('productos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \SportStore\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SportStore\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $categorias = Producto::all()->pluck('categoria')->unique();
        return view('admin.productos.editar')
            ->with('producto', $producto)
            ->with('categorias', $categorias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SportStore\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $this->validarDatos($request);

        $producto->update(Input::all());
        $msg = 'El producto se ha actualizado satisfactoriamente';
        \Utils::enviarMensaje('Éxito', 'success', $msg);
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SportStore\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        $msg = 'El producto ha sido eliminado satisfactoriamente';
        \Utils::enviarMensaje('Éxito', 'success', $msg);
        return redirect()->route('productos.index');
    }

    protected function validarDatos(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|url'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'descripcion.required' => 'El campo descripcion es obligatorio',
            'categoria.required' => 'El campo categoria es obligatorio',
            'precio.required' => 'El campo precio es obligatorio',
            'precio.number' => 'El campo precio debe tener un valor numérico',
            'precio.min' => 'El campo precio debe tener un valor mayor o igual a cero (0)',
            'imagen.url' => 'El campo imagen debe tener una URL válida. Ej. http://servidor.com/imagen.jpg'
        ]);
    }
}
