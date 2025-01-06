@extends('layout.layout')
@section('content')
<div class="container vh-100 d-flex flex-column justify-content-center align-items-center">
    <h1 class="mb-4">Choose Your Registration Type</h1>
    <div class="row w-100">
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3 class="card-title">Passenger Registration</h3>
                    <p class="card-text">If you're looking for a ride, register as a passenger.</p>
                    <a href="/passenger-registration" class="btn btn-primary w-100">Register as Passenger</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h3 class="card-title">Pilot Registration</h3>
                    <p class="card-text">Want to offer rides? Register as a Pilot here.</p>
                    <a href='/pilot-registration' class="btn btn-secondary w-100">Register as Pilot</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@endsection