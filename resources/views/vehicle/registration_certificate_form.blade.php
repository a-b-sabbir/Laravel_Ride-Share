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
                        <form action="{{ route('upload.registration-certificate') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <input type="hidden" class="form-control" name="vehicle_id" id="vehicle_id" value={{ $vehicleID }}>

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
                            <!-- Registration No -->
                            <div class="mb-3">
                                <label for="registration_number" class="form-label fw-bold required">Registration No</label>
                                <input type="text" class="form-control" name="registration_number" id="registration_number">
                                @if ($errors->has('registration_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('registration_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Date -->
                            <div class="mb-3">
                                <label for="date" class="form-label fw-bold required">Date</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            @if($errors->has('date'))
                            <div class="text-danger">
                                <small>{{ $errors->first('date') }}</small>
                            </div>
                            @endif

                            <!-- Vehicle Description -->
                            <div class="mb-3">
                                <label for="vehicle_description" class="form-label fw-bold required">Vehicle Description</label>
                                <input type="text" class="form-control" id="vehicle_description" name="vehicle_description">
                            </div>
                            @if($errors->has('vehicle_description'))
                            <div class="text-danger">
                                <small>{{ $errors->first('vehicle_description') }}</small>
                            </div>
                            @endif

                            <!-- Vehicle Class -->
                            <div class="mb-3">
                                <label for="vehicle_class" class="form-label fw-bold required">Vehicle Class</label>
                                <input type="text" class="form-control" id="vehicle_class" name="vehicle_class">
                            </div>
                            @if($errors->has('vehicle_class'))
                            <div class="text-danger">
                                <small>{{ $errors->first('vehicle_class') }}</small>
                            </div>
                            @endif

                            <!-- Color -->
                            <div class="mb-3">
                                <label for="color" class="form-label fw-bold required">Color</label>
                                <input type="text" class="form-control" id="color" name="color">
                            </div>
                            @if($errors->has('color'))
                            <div class="text-danger">
                                <small>{{ $errors->first('color') }}</small>
                            </div>
                            @endif

                            <!-- CC -->
                            <div class="mb-3">
                                <label for="cc" class="form-label fw-bold required">CC</label>
                                <input type="text" class="form-control" id="cc" name="cc">
                            </div>
                            @if($errors->has('cc'))
                            <div class="text-danger">
                                <small>{{ $errors->first('cc') }}</small>
                            </div>
                            @endif

                            <!-- Fuel -->
                            <div class="mb-3">
                                <label for="fuel" class="form-label fw-bold required">fuel</label>
                                <input type="text" class="form-control" id="fuel" name="fuel">
                            </div>
                            @if($errors->has('fuel'))
                            <div class="text-danger">
                                <small>{{ $errors->first('fuel') }}</small>
                            </div>
                            @endif

                            <!-- Seat -->
                            <div class="mb-3">
                                <label for="seat" class="form-label fw-bold required">Seat</label>
                                <input type="text" class="form-control" id="seat" name="seat">
                            </div>
                            @if($errors->has('seat'))
                            <div class="text-danger">
                                <small>{{ $errors->first('seat') }}</small>
                            </div>
                            @endif

                            <!-- Engine No -->
                            <div class="mb-3">
                                <label for="engine_no" class="form-label fw-bold required">Engine No</label>
                                <input type="text" class="form-control" id="engine_no" name="engine_no">
                            </div>
                            @if($errors->has('engine_no'))
                            <div class="text-danger">
                                <small>{{ $errors->first('engine_no') }}</small>
                            </div>
                            @endif

                            <!-- Chassis No -->
                            <div class="mb-3">
                                <label for="chassis_no" class="form-label fw-bold required">Chassis No</label>
                                <input type="text" class="form-control" id="chassis_no" name="chassis_no">
                            </div>
                            @if($errors->has('chassis_no'))
                            <div class="text-danger">
                                <small>{{ $errors->first('chassis_no') }}</small>
                            </div>
                            @endif

                            <!-- Hire -->
                            <div class="mb-3">
                                <label for="hire" class="form-label fw-bold required">Hire</label>
                                <select class="form-select" name="hire" id="hire">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                            @if($errors->has('hire'))
                            <div class="text-danger">
                                <small>{{ $errors->first('hire') }}</small>
                            </div>
                            @endif

                            <!-- Wheel Base -->
                            <div class="mb-3">
                                <label for="wheelbase" class="form-label fw-bold required">Wheel Base</label>
                                <input type="text" class="form-control" id="wheelbase" name="wheelbase">
                            </div>
                            @if($errors->has('wheelbase'))
                            <div class="text-danger">
                                <small>{{ $errors->first('wheelbase') }}</small>
                            </div>
                            @endif

                            <!-- Unladen Weight -->
                            <div class="mb-3">
                                <label for="unladen_weight" class="form-label fw-bold required">Unladen Weight</label>
                                <input type="text" class="form-control" id="unladen_weight" name="unladen_weight">
                            </div>
                            @if($errors->has('unladen_weight'))
                            <div class="text-danger">
                                <small>{{ $errors->first('unladen_weight') }}</small>
                            </div>
                            @endif

                            <!-- Laden Weight -->
                            <div class="mb-3">
                                <label for="laden_weight" class="form-label fw-bold required">Laden Weight</label>
                                <input type="text" class="form-control" id="laden_weight" name="laden_weight">
                            </div>
                            @if($errors->has('laden_weight'))
                            <div class="text-danger">
                                <small>{{ $errors->first('laden_weight') }}</small>
                            </div>
                            @endif

                            <!-- Issuing Authority -->
                            <div class="mb-3">
                                <label for="issuing_authority" class="form-label fw-bold required">Issuing Authority</label>
                                <input type="text" class="form-control" id="issuing_authority" name="issuing_authority">
                            </div>
                            @if($errors->has('issuing_authority'))
                            <div class="text-danger">
                                <small>{{ $errors->first('issuing_authority') }}</small>
                            </div>
                            @endif

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