@extends("layout.layout")

@section("content")

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <center>Login</center>
                    </h4>
                    <form action="{{ url('/login_post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" value="" name="password" class="form-control" id="exampleInputPassword1">
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>
                        <a href="{{ url('/forgot') }}">Forgot Password?</a>
                        <br>
                        <br>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>

                <br>
                <label>Not A Member?</label> <a href="{{url('/registration')}}">Join now</a>
            </div>
        </div>
    </div>
</div>

@endsection