<div class="text-white ml-auto mt-2 mr-2 text-right">
    <a href="{{ route('carrito.limpiar') }}" class="fa fa-eraser unlink" title="Limpiar Carrito"></a>
    <a class="unlink" href="{{ route('carrito.index') }}">
        <span>
            @if (\Auth::check())
                Carrito de {{ \Auth::user()->getPrimerNombre() }}
            @else
                Tu Carrito
            @endif
        </span><br/>
        <i class="fa fa-shopping-cart fa-lg"></i>
        {{ $carrito->total_items() }} items
        @formatcurrency($carrito->total_carrito())
    </a>
</div>
