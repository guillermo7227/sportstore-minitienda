@extends('master')
@section('title', 'Acerca de')
@section('content')
    <h2 class="text-center mb-3">Acerca de SportStore</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">Resumen</h3>
                    <p class="card-text">
                        <strong>SportStore</strong> es una mini tienda web desarrollada por
                        Guillermo Agudelo como parte de su portafolio.
                    </p>
                    <h3 class="card-title">Características</h3>
                    <ul>
                        <li><strong>Autenticación de usuarios. </strong>
                            Es necesario iniciar sesión para acceder a algunas funcionalidades (por ej. para completar una compra.)</li>
                        <li><strong>Autorización mediante roles. </strong>
                            El módulo de Administración sólo es accesible para usuarios con rol de administrador
                        </li>
                        <li><strong>Diseño responsive. </strong>
                            El sitio web es totalmente compatible con dispositivos móviles y se adapta fluidamente al tamaño de la pantalla del visitante.
                        </li>
                    </ul>
                    <h3 class="card-title">Tecnologías</h3>
                    <ul>
                        <li>Laravel 5.8 Framework PHP</li>
                        <li>MySQL Base de datos</li>
                        <li>Bootstrap 4</li>
                        <li>Test Driven Development (Desarrollo basado en Pruebas) con PHPUnit</li>
                        <li>Git Control de Versiones</li>
                    </ul>
                    <h3 class="card-title">Código fuente</h3>
                    <p class="card-text">
                        El código fuente de este sitio está disponible en GitHub
                        <a href="https://github.com/guillermo7227/sportstore" target="_blank">aquí</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h4 class="card-header">Acerca del Autor</h4>
                <div class="card-body">
                    <h5 class="card-title">Guillermo J. Agudelo A. (guille.agudelo@gmail.com)</h5>
                    <img class="rounded-circle border border-info float-left mr-3"
                        src="{{ asset('img/autor.jpg') }}" height="140" width="140">
                    <p class="card-text">
                        Tecnólogo en Desarrollo de Sistemas de Información egresado del SENA
                        y estudiante de 8vo. semestre de Ingeniería de Sistemas en la Universidad Nacional Abierta y a Distancia.
                    </p>
                    <p class="card-text">
                        Ha desarrollado aplicaciones de escritorio con la tecnología .NET y su actual enfoque es el
                        desarrollo de Sitios Web.
                    </p>
                    <a href="mailto:guille.agudelo@gmail.com" class="btn btn-outline-primary">Envíame un Email</a>
                </div>
            </div>
        </div>
    </div>
@endsection
