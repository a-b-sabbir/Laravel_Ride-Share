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


                            <!-- Vehicle Class -->
                            <div class="mb-3">
                                <label for="vehicle_class" class="form-label">Vehicle Class</label>
                                <input type="text" class="form-control" id="vehicle_class" name="vehicle_class" value="{{ old('vehicle_class', $details['vehicle_class'] ?? '') }}">
                            </div>
                            <!-- Color -->
                            <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $details['color'] ?? '') }}">
                            </div>

                            <!-- CC -->
                            <div class="mb-3">
                                <label for="registration_no" class="form-label">Registration No.</label>
                                <input type="text" class="form-control" id="registration_no" name="registration_no" value="{{ old('registration_no', $details['registration_no'] ?? '') }}">
                            </div>

                            <!-- Engine No. -->
                            <div class="mb-3">
                                <label for="engine_no" class="form-label">Engine No.</label>
                                <input type="text" class="form-control" id="engine_no" name="engine_no" value="{{ old('engine_no', $details['engine_no'] ?? '') }}">
                            </div>


                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $details['date'] ?? '') }}" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection