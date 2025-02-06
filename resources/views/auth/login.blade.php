@extends("layout.layout")

@section("content")

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
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

                <div class="card-footer text-center">
                    <span>Not a member? </span>
                    <a href="{{url('/chooseregistration')}}" class="btn btn-link btn-sm text-primary">Join Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection