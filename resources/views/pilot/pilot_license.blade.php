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
                        <center>Pilot Driving License</center>
                    </h4>
                    <div class="mb-3">
                        <form action="{{ route('license.upload') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="pilot_id" value="{{ $pilotId }}">

                            <!-- License Photo -->
                            <div class="mb-3">
                                <label for="license_photo" class="form-label fw-bold required">License Photo</label>
                                <input type="file" class="form-control" name="license_photo" id="license_photo">
                                @if ($errors->has('license_photo'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('license_photo') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Type -->
                            <div class="mb-3">
                                <label for="type" class="form-label fw-bold required">Type</label>
                                <select class="form-select" name="type" id="type">
                                    <option value="Professional">Professional</option>
                                    <option value="Non-Professional" selected>Non-Professional</option>
                                </select>
                                @if($errors->has('type'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('type') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold required">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                                @if ($errors->has('name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold required">Address</label>
                                <input type="address" class="form-control" name="address" id="address" placeholder="Enter your address" value="{{ old('address') }}" required>
                                @if($errors->has('address'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('address') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Birth Date -->
                            <div class="mb-3">
                                <label for="birth_date" class="form-label fw-bold required">Birth Date</label>
                                <input type="date" class="form-control" name="birth_date" id="birth_date" placeholder="Enter Birth Date" value="{{ old('birth_date') }}" required>
                                @if($errors->has('birth_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('birth_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Blood Group -->
                            <div class="mb-3">
                                <label for="blood_group" class="form-label fw-bold required">Blood Group</label>
                                <select class="form-select" name="blood_group" id="blood_group">
                                    <option value="A+">A+</option>
                                    <option value="A-" selected>A-</option>
                                    <option value="B+">B+</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="B-">B-</option>
                                </select>
                                @if($errors->has('blood_group'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('blood_group') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Father or Husband Name -->
                            <div class="mb-3">
                                <label for="father_or_husband_name" class="form-label fw-bold required">Father or Husband Name</label>
                                <input type="father_or_husband_name" class="form-control" name="father_or_husband_name" id="father_or_husband_name" placeholder="Enter Father or Husband Name" value="{{ old('father_or_husband_name') }}" required>
                                @if($errors->has('father_or_husband_name'))
                                <div class="text-danger">
                                    <small>{{$errors->first('father_or_husband_name')}}</small>
                                </div>
                                @endif
                            </div>

                            <!-- License Number -->
                            <div class="mb-3">
                                <label for="license_number" class="form-label fw-bold required">License Number</label>
                                <input type="license_number" class="form-control" name="license_number" id="license_number" placeholder="Enter your License Number" value="{{ old('license_number') }}" required>
                                @if($errors->has('license_number'))
                                <div class="text-danger">
                                    <small>{{$errors->first('license_number')}}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Issue Date -->
                            <div class="mb-3">
                                <label for="issue_date" class="form-label fw-bold required">Issue Date</label>
                                <input type="date" class="form-control" name="issue_date" id="issue_date" placeholder="Enter Issue Date" value="{{ old('issue_date') }}" required>
                                @if($errors->has('issue_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('issue_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Expiry Date -->
                            <div class="mb-3">
                                <label for="expiry_date" class="form-label fw-bold required">Expiry Date</label>
                                <input type="date" class="form-control" name="expiry_date" id="expiry_date" placeholder="Enter Expiry Date" value="{{ old('expiry_date') }}" required>
                                @if($errors->has('expiry_date'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('expiry_date') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Ref No -->
                            <div class="mb-3">
                                <label for="ref_no" class="form-label fw-bold required">Ref No</label>
                                <input type="ref_no" class="form-control" name="ref_no" id="ref_no" placeholder="Enter your Ref no." value="{{ old('ref_no') }}" required>
                                @if($errors->has('ref_no'))
                                <div class="text-danger">
                                    <small>{{$errors->first('ref_no')}}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Issuing Authority -->
                            <div class="mb-3">
                                <label for="issuing_authority" class="form-label fw-bold required">Issuing Authority</label>
                                <select class="form-select" name="issuing_authority" id="issuing_authority">
                                    <option value="Mirpur BRTA">Mirpur BRTA</option>
                                    <option value="Equria BRTA">Equria BRTA</option>
                                </select>
                                @if($errors->has('blood_group'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('blood_group') }}</small>
                                </div>
                                @endif
                            </div>


                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection