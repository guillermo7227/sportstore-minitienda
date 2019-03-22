<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'TiendaController@index')->name('tienda.index');
Route::get('/categoria/{categoria}', 'TiendaController@mostrarPorCategoria')->name('tienda.categoria');

Route::group([
    'prefix' => '/carrito'
], function () {
    Route::get('/', 'CarritoController@index')->name('carrito.index');
    Route::get('/limpiar', 'CarritoController@limpiar')->name('carrito.limpiar');
    Route::get('/agregar/{producto}', 'CarritoController@agregar')->name('carrito.agregar');
    Route::get('/eliminar/{producto}', 'CarritoController@eliminar')->name('carrito.eliminar');
    Route::get('/modificarcantidad/{producto}', 'CarritoController@modificarCantidad')
        ->name('carrito.modificarcantidad');
});

Route::get('/iniciarsesion', 'AutenticacionController@index')->name('autenticacion.index');
Route::get('/iniciarsesion/autenticar', 'AutenticacionController@autenticar')->name('autenticacion.autenticar');
Route::get('/cerrarsesion', 'AutenticacionController@cerrarSesion')->name('autenticacion.cerrarsesion');

Route::group([
    'middleware' => ['auth', 'rol:admin'],
    'prefix' => '/admin',
], function () {
    Route::get('/', 'TiendaController@mostrarAdmin')->name('admin.index');
    Route::resource('productos', 'ProductoController');
    Route::put('/ordenes/{orden}/enviar', 'OrdenController@enviarOrden')->name('ordenes.enviar');
    Route::resource('ordenes', 'OrdenController', ['parameters' => ['ordenes' => 'orden']])
        ->except(['create', 'store', 'show']);
});

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('/ordenes/nuevo', 'OrdenController@create')->name('ordenes.create');
    Route::post('/ordenes', 'OrdenController@store')->name('ordenes.store');
    Route::get('/ordenes/misordenes', 'OrdenController@misOrdenes')->name('ordenes.misordenes');
    Route::get('/ordenes/{orden}', 'OrdenController@show')->name('ordenes.show');
});

Route::get('/acercade', 'TiendaController@acercaDe')->name('acercade');

Route::get('/test', 'TiendaController@test')->name('test');
