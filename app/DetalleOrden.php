<?php

namespace SportStore;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $table = 'detalles_orden';

    protected $fillable = [
        'orden_id',
        'producto_id',
        'nombre',
        'descripcion',
        'categoria',
        'precio',
        'cantidad',
        'total_linea'
    ];
}
