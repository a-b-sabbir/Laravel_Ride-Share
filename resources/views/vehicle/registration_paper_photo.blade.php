@extends('layout.layout')

@section('content')
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
                        <center>Vehicle Registration Paper Form</center>
                    </h4>
                    <div class="mb-3">
                        <form action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <!-- Registration Photo -->
                            <div class="mb-3">
                                <label for="registration_photo" class="form-label fw-bold required">Registration Paper Photo</label>
                                <input type="file" class="form-control" name="registration_photo" id="registration_photo">

                                @if ($errors->has('registration_photo'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('registration_photo') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg w-100">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection