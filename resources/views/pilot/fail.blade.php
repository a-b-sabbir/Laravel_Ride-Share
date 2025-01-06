<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failure</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
        <a href="{{ route('pilot') }}" class="btn btn-primary">Try Again</a>
    </div>
</body>
</html>
