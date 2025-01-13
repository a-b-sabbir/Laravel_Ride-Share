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
                        <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <!-- Color -->
                            <div class="mb-3">
                                <label for="color" class="form-label fw-bold required">Color</label>
                                <select class="form-select" name="color" id="color" required>
                                    <option value="disabled selected">Select Color</option>
                                    <option value="White">White</option>
                                    <option value="Black">Black</option>
                                    <option value="Red">Red</option>
                                    <option value="Silver">Silver</option>
                                    <option value="Yellow">Yellow</option>
                                </select>
                                @if($errors->has('color'))
                                <div class="danger">
                                    <small>{{ $errors->first('color') }}</small>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection