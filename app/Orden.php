<?php

namespace SportStore;

use SportStore\User;
use SportStore\DetalleOrden;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'ordenes';
    protected $fillable = [
        // se llena manualmente
        'user_id',

        // se llena desde el carrito
        'total_items',
        'total_orden',

        // se llanan desde el request
        'nombre',
        'direccion',
        'ciudad',
        'estado',
        'codigo_postal',
        'pais',
        'enviado',
    ];

    public function detalles()
    {
        return $this->hasMany(DetalleOrden::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
