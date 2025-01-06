@extends("layout.layout")

@section("content")

<form action="{{ url('forgot') }}" method="POST">
    @csrf
    <div class="container m-3">
        <div class="wrapper">
            <center>
                <h2>Recover Password</h2>
            </center>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <br>
            <button type="submit" class="btn btn-success">Get Code</button>
        </div>
        <br>
        <label>Remembered Password?</label> <a href="{{url('/login')}}">Login</a>
    </div>
    </div>
</form>

@endsection