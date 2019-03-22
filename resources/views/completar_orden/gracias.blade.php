@extends('master')
@section('title', '¡Gracias por su compra!')
@section('content')
    <div class="text-center m-5">
        <h4>¡Gracias por su compra!</h4>
        <p>Su orden será despachada en breve</p>
        <a class="btn btn-secondary text-white" href="{{ route('tienda.index') }}">
            Volver a la tienda
        </a>
    </div>
@endsection
