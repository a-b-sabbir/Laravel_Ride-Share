@extends("layout.layout")

@section("content")

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <center>Registration</center>
                    </h4>
                    <form action="{{ route('passenger_register') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="name" class="form-label fw-bold required">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" aria-describedby="name">
                        </div>
                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label fw-bold required">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control" id="address" aria-describedby="address">
                        </div>

                        <!-- Countries -->
                        <div class="mb-3">
                            <label for="country" class="form-label fw-bold required">Country</label>
                            <select class="form-select" name="country" id="country">
                                <option value="Bangladesh" selected>Bangladesh</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Egypt">Egypt</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label fw-bold required">Phone Number</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control" id="phone_number">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label fw-bold required">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label fw-bold required">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label fw-bold required">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword2">
                        </div>
                        <div class="mb-3">
                            <label for="emergency_contact_name" class="form-label fw-bold required">Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="form-control" id="emergency_contact_name">
                        </div>
                        <div class="mb-3">
                            <label for="emergency_contact_number" class="form-label fw-bold required">Emergency Contact Number</label>
                            <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}" class="form-control" id="emergency_contact_number">
                        </div>
                        <div class="mb-3">
                            <label for="relation_with_emergency_contact" class="form-label fw-bold required">Relation with Emergency Contact</label>
                            <input type="text" name="relation_with_emergency_contact" value="{{ old('relation_with_emergency_contact') }}" class="form-control" id="relation_with_emergency_contact">
                        </div>
                        <!-- Referral Code -->
                        <div class="mb-3">
                            <label for="text" class="form-label fw-bold">Referral Code (If any:)</label>
                            <input type="text" id="referral_code" name="referral_code" class="form-control">
                            @if ($errors->has('referral_code'))
                            <div class="text-danger">
                                <small>{{ $errors->first('referral_code') }}</small>
                            </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
                <br>
                <label>Already A Member</label> <a href="{{url('/login')}}">Login</a>
            </div>
        </div>
    </div>
</div>


@endsection