<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('logo_zarib.jpg') }}">
    <title>Ride-Share</title>
    <style>
        footer {
            background: #eee;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    @include('layout.common.navbar')
    <div class="container">
        <br>
        @yield('content')
    </div>
    <br>
    <footer>
        Copyright 2024 Pizzaburg
    </footer>
</body>

</html>