@extends("layout.layout")

@section("content")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <!-- pilot.success.blade.php -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <h4>
                        <center>Pilot Driving License Photo</center>
                    </h4>
                    <div class="mb-3">
                        <form action="{{ route('license.upload') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
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