{{-- {{ dd(session()->all()) }} --}}
@if (session()->has('mensaje'))
    <h5 class="alert alert-{{ session('mensaje')['clase'] }} escondeme text-center">
        <strong>{{ session('mensaje')['tipo'] }}: </strong>{{ session('mensaje')['msg'] }}
    </h5>
@endif
