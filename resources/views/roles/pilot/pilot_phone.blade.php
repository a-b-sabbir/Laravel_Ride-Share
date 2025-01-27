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
                        <form action="{{ route('send-otp') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
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
</div>

@endsection