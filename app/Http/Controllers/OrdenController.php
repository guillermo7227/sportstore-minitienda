<?php

namespace SportStore\Http\Controllers;

use SportStore\Orden;
use SportStore\Carrito;
use Illuminate\Http\Request;
use SportStore\DetalleOrden;
use Illuminate\Support\Facades\Input;
use SportStore\Jobs\EmailOrdenCompleta;

class OrdenController extends Controller
{

    protected $carrito;

    public function __construct(Carrito $carrito) {
        $this->carrito = $carrito;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ordenes = null;

        if ($request->mostrarEnviadas) {
            $ordenes = Orden::orderBy('id')->paginate(5);
        } else {
            $ordenes = Orden::orderBy('id')->where('enviado', false)->paginate(5);
        }

        return view('admin.admin')
            ->with('ordenes', $ordenes);
            // ->with('detalles_orden', new DetalleOrden);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->carrito->carrito_vacio()) {
            $msg = 'El carrito está vacío. Para completar una compra, agregue productos desde la tienda.';
            \Utils::enviarMensaje('Error', 'danger', $msg);
            return redirect()->route('carrito.index');
        }

        return view('completar_orden.info_envio')
            ->with('carrito', $this->carrito);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->carrito->carrito_vacio()) {
            $msg = 'El carrito está vacío. Para completar una compra, agregue productos desde la tienda.';
            \Utils::enviarMensaje('Error', 'danger', $msg);
            return redirect()->route('carrito.index');
        }


        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'estado' => 'required',
            'codigo_postal' => 'nullable',
            'pais' => 'required'
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'ciudad.required' => 'El campo ciudad es obligatorio.',
            'estado.required' => 'El campo estado es obligatorio.',
            'pais.required' => 'El campo pais es obligatorio.',
        ]);

        $datos_orden = array_merge([
            'user_id' => \Auth::id(),
            'total_items' => $this->carrito->total_items(),
            'total_orden' => $this->carrito->total_carrito()
        ], Input::all());

        $nueva_orden = Orden::create($datos_orden);

        // Crea los registros en detalles_orden
        $lineas = $this->carrito->lineas();
        foreach ($lineas as $key => $linea) {
            $producto = $linea['producto'];
            $datos_detalle_orden = [
                'orden_id' => $nueva_orden->id,
                'producto_id' => $producto->id,
                'nombre' => $producto->nombre,
                'descripcion' => $producto->descripcion,
                'categoria' => $producto->categoria,
                'precio' => $producto->precio,
                'cantidad' => $linea['cantidad'],
                'total_linea' => $linea['total_linea']
            ];
            DetalleOrden::create($datos_detalle_orden);
        }

        $this->carrito->limpiar_carrito();

        EmailOrdenCompleta::dispatch($nueva_orden);

        return view('completar_orden.gracias')
            ->with('carrito', $this->carrito);
    }

    /**
     * Display the specified resource.
     *
     * @param  \SportStore\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden)
    {
        if (! \Auth::user()->esAdmin() && \Auth::id() != $orden->user_id) {
            return abort(403, 'No tiene permisos para ver esta información');
        }

        return view('ordenes.detalle')
            ->with('orden', $orden);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \SportStore\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \SportStore\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
    }

    public function enviarOrden(Request $request, Orden $orden)
    {
        $orden->update(Input::all());

        $msg = 'La orden ha sido marcada como Enviada satisfactoriamente';
        \Utils::enviarMensaje('Éxito', 'success', $msg);

        return redirect()->route('ordenes.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \SportStore\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        DetalleOrden::where('orden_id', $orden->id)->delete();
        $orden->delete();
        return redirect()->route('ordenes.index');
    }

    public function misOrdenes(Request $request)
    {
        $ordenes = Orden::where('user_id', \Auth::id())->orderBy('id');

        if ($request->mostrarEnviadas) {
            $ordenes = $ordenes->paginate(5);
        } else {
            $ordenes = $ordenes->where('enviado', false)->paginate(5);
        }

        return view('ordenes.mis_ordenes')
            ->with('ordenes', $ordenes);
    }
}
