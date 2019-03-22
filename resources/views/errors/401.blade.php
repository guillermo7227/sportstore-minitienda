
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>SportStore | Error 401</title>
</head>
<body>
    <div class="container-fluid">
        <div class="text-center m-5">
            <h5 class="mb-3">SportStore</h5>
            <h2>Error 401 | Sin autorización</h2>
            <p>{{ $exception->getMessage() }}</p>
            <p>Por favor <a href="{{ route('autenticacion.index') }}">inicie sesión</a></p>
        </div>
    </div>
</body>
</html>
