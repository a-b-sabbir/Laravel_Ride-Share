<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
</head>

<body>
    <h2>Enter the OTP you received</h2>
    <form action="" method="POST">
        @csrf
        <label for="otp">OTP:</label>
        <input type="text" id="otp" name="otp" required maxlength="6">

        @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <button type="submit">Verify OTP</button>
    </form>
</body>

</html>