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
                        <center>Fitness Certificate Form</center>
                    </h4>
                    <div class="mb-3">
                        <form action="{{ route('vehicle.uploadFitness') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf

                            <!-- Vehicle ID -->
                            <input type="hidden" class="form-control" name="vehicle_id" id="vehicle_id" value="{{ $vehicleID }}">
                            @if ($errors->has('vehicle_id'))
                            <div class="text-danger">
                                <small>{{ $errors->first('vehicle_id') }}</small>
                            </div>
                            @endif

                            <!-- Fitness Photo -->
                            <div class="mb-3">
                                <label for="fitness_photo" class="form-label fw-bold required">Fitness Photo</label>
                                <input type="file" class="form-control" name="fitness_photo" id="fitness_photo">
                                @if ($errors->has('fitness_photo'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('fitness_photo') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Vehicle Identity No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Vehicle Identity No.</label>
                                <input type="text" id="vehicle_identity_no" name="vehicle_identity_no" class="form-control">
                                @if ($errors->has('vehicle_identity_no'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('vehicle_identity_no') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- User Identity No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">User Identity No.</label>
                                <input type="text" id="user_identity_no" name="user_identity_no" class="form-control">
                                @if ($errors->has('user_identity_no'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('user_identity_no') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Registration No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Registration No.</label>
                                <input type="text" id="registration_no" name="registration_no" class="form-control" value="{{ $registration_number }}" readonly>
                                @if ($errors->has('registration_no'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('registration_no') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Certificate No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Certificate No.</label>
                                <input type="text" id="certificate_no" name="certificate_no" class="form-control">
                                @if ($errors->has('certificate_no'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('certificate_no') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Vehicle Description -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Vehicle Description</label>
                                <input type="text" id="vehicle_description" name="vehicle_description" class="form-control">
                                @if ($errors->has('vehicle_description'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('vehicle_description') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Chassis No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Chassis No.</label>
                                <input type="text" id="chassis_no" name="chassis_no" class="form-control">
                                @if ($errors->has('chassis_no'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('chassis_no') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Engine No -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Engine No.</label>
                                <input type="text" id="engine_no" name="engine_no" class="form-control">
                                @if ($errors->has('engine_no'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('engine_no') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Hired -->
                            <div class="mb-3">
                                <label for="hired" class="form-label fw-bold required">Hired</label>
                                <select class="form-select" name="hired" id="hired">
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                            @if($errors->has('hired'))
                            <div class="text-danger">
                                <small>{{ $errors->first('hired') }}</small>
                            </div>
                            @endif

                            <!-- Seats -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Seats</label>
                                <input type="text" id="seats" name="seats" class="form-control">
                                @if ($errors->has('seats'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('seats') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Cylinder -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Cylinder</label>
                                <input type="text" id="cylinder" name="cylinder" class="form-control">
                                @if ($errors->has('cylinder'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('cylinder') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- CC -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">CC</label>
                                <input type="text" id="cc" name="cc" class="form-control">
                                @if ($errors->has('cc'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('cc') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Unladen Weight -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Unladen Weight</label>
                                <input type="text" id="unladen_weight" name="unladen_weight" class="form-control">
                                @if ($errors->has('unladen_weight'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('unladen_weight') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Laden Weight -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Laden Weight</label>
                                <input type="text" id="laden_weight" name="laden_weight" class="form-control">
                                @if ($errors->has('laden_weight'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('laden_weight') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Color -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Color</label>
                                <input type="text" id="color" name="color" class="form-control">
                                @if ($errors->has('color'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('color') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- No. of Tyres -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">No. of Tyres</label>
                                <input type="text" id="number_of_tyres" name="number_of_tyres" class="form-control">
                                @if ($errors->has('number_of_tyres'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('number_of_tyres') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Size of Tyres -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Size of Tyres</label>
                                <input type="text" id="size_of_tyre" name="size_of_tyre" class="form-control">
                                @if ($errors->has('size_of_tyre'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('size_of_tyre') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Dimension-Length -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Dimension-Length</label>
                                <input type="text" id="dimension_length" name="dimension_length" class="form-control">
                                @if ($errors->has('dimension_length'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('dimension_length') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Dimension-Width -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Dimension-Width</label>
                                <input type="text" id="dimension_width" name="dimension_width" class="form-control">
                                @if ($errors->has('dimension_width'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('dimension_width') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Dimension-Height -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Dimension-Height</label>
                                <input type="text" id="dimension_height" name="dimension_height" class="form-control">
                                @if ($errors->has('dimension_height'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('dimension_height') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Front Overhang -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Front Overhang</label>
                                <input type="text" id="front_overhang" name="front_overhang" class="form-control">
                                @if ($errors->has('front_overhang'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('front_overhang') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Back Overhang -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Back Overhang</label>
                                <input type="text" id="back_overhang" name="back_overhang" class="form-control">
                                @if ($errors->has('back_overhang'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('back_overhang') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                                @if ($errors->has('name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Husband or Father Name -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Husband or Father Name</label>
                                <input type="text" id="husband_or_father_name" name="husband_or_father_name" class="form-control">
                                @if ($errors->has('husband_or_father_name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('husband_or_father_name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Address</label>
                                <input type="text" id="address" name="address" class="form-control">
                                @if ($errors->has('address'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('address') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- TIN -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">TIN</label>
                                <input type="text" id="TIN" name="TIN" class="form-control">
                                @if ($errors->has('TIN'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('TIN') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Issue Date -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Issue Date</label>
                                <input type="date" id="issue_date" name="issue_date" class="form-control">
                                @if ($errors->has('issue_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('issue_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Start Period -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Start Period</label>
                                <input type="date" id="fitness_period_start" name="fitness_period_start" class="form-control">
                                @if ($errors->has('fitness_period_start'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('fitness_period_start') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- End Period -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">End Period</label>
                                <input type="date" id="fitness_period_end" name="fitness_period_end" class="form-control">
                                @if ($errors->has('fitness_period_end'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('fitness_period_end') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Inspector Name -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Inspector Name</label>
                                <input type="text" id="inspector_name" name="inspector_name" class="form-control">
                                @if ($errors->has('inspector_name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('inspector_name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Inspector Designation -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Inspector Designation</label>
                                <input type="text" id="inspector_designation" name="inspector_designation" class="form-control">
                                @if ($errors->has('inspector_designation'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('inspector_designation') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Inspector Area -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Inspector Area</label>
                                <input type="text" id="inspector_area" name="inspector_area" class="form-control">
                                @if ($errors->has('inspector_area'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('inspector_area') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Inspector Date -->
                            <div class="mb-3">
                                <label for="text" class="form-label fw-bold required">Inspection Date</label>
                                <input type="date" id="inspection_date" name="inspection_date" class="form-control">
                                @if ($errors->has('inspection_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('inspection_date') }}</small>
                                </div>
                                @endif
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