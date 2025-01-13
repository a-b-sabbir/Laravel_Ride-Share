@extends("layout.layout")

@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <center>Pilot Registration</center>
                    </h4>
                    <div class="mb-3">
                        <form action="{{ route('pilot_register') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <!-- Profile Photo -->
                            <div class="mb-3">
                                <label for="profile_photo" class="form-label fw-bold required">Profile Photo</label>
                                <input type="file" class="form-control" name="profile_photo" id="profile_photo">

                                @if ($errors->has('profile_photo'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('profile_photo') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold required">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                                <div class="invalid-feedback">Name is required.</div>
                                @if ($errors->has('name'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('name') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold required">Email Address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email address" value="{{ old('email') }}" required>
                                <div class="invalid-feedback">Please provide a valid email.</div>
                                @if($errors->has('email'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('email') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold required">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter a strong password" required>
                                <div class="invalid-feedback">Password is required.</div>
                                @if($errors->has('password'))
                                <div class="text-danger">
                                    <small>{{$errors->first('password')}}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label fw-bold required">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Re-enter your password" required>
                                <div class="invalid-feedback">Passwords must match.</div>
                                @if($errors->has('confirm_password'))
                                <div class="text-danger">
                                    <small>{{$errors->first('confirm_password')}}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label for="phone_number" class="form-label fw-bold required">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter your phone number" value="{{ old('phone_number') }}" required>
                                <div class="invalid-feedback">Phone number is required.</div>
                                @if($errors->has('phone_number'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('phone_number') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- NID -->
                            <div class="mb-3">
                                <label for="nid" class="form-label fw-bold required">National ID (NID)</label>
                                <input type="text" class="form-control" name="nid" id="nid" placeholder="Enter your NID number" value="{{ old('nid') }}" pattern="\d{10}|\d{13}|\d{17}" required>
                                <div class="invalid-feedback">NID is required.</div>
                                <div class="invalid-feedback">
                                    @if($errors->has('nid'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('nid') }}</small>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- NID Image -->
                            <div class="mb-3">
                                <label for="nid_image" class="form-label fw-bold required">NID Image</label>
                                <input type="file" class="form-control" name="nid_image" id="nid_image" required>
                                <div class="invalid-feedback">NID image is required.</div>
                                @if($errors->has('nid_image'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('nid_image') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Address -->
                            <div class="mb-3">
                                <label for="address" class="form-label fw-bold required">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter your address" value="{{ old('address') }}" required>
                                <div class="invalid-feedback">Address is required.</div>
                                @if($errors->has('address'))
                                <div class="text-danger">
                                    <small>{{ $errors->first('address') }}</small>
                                </div>
                                @endif
                            </div>

                            <!-- Emergency Contact Details -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="emergency_contact_name" class="form-label fw-bold required">Emergency Contact Name</label>
                                    <input type="text" class="form-control" name="emergency_contact_name" id="emergency_contact_name" placeholder="Name of emergency contact" value="{{ old('emergency_contact_name') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="emergency_contact_number" class="form-label fw-bold required">Emergency Contact Number</label>
                                    <input type="text" class="form-control" name="emergency_contact_number" id="emergency_contact_number" placeholder="Contact number" value="{{ old('emergency_contact_number') }}">
                                    @if($errors->has('emergency_contact_number'))
                                    <div class="text-danger">
                                        <small>{{ $errors->first('emergency_contact_number') }}</small>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Relation with Emergency Contact -->
                            <div class="mb-3">
                                <label for="relation_with_emergency_contact" class="form-label fw-bold required">Relation with Emergency Contact</label>
                                <input type="text" class="form-control" name="relation_with_emergency_contact" id="relation_with_emergency_contact" placeholder="e.g., Father, Friend" value="{{ old('relation_with_emergency_contact') }}">
                            </div>

                            <!-- Preferred Shift -->
                            <div class="mb-3">
                                <label for="preferred_shift" class="form-label fw-bold required">Preferred Shift</label>
                                <select class="form-select" name="preferred_shift" id="preferred_shift">

                                    <option value="day">Day</option>
                                    <option value="night">Night</option>
                                    <option value="flexible" selected>Flexible</option>
                                </select>
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