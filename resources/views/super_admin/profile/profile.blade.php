@extends('layout.super_admin.layout')

@section('content')
<div class="container mt-5">
    <!-- Profile Header -->
    <div class="profile-header text-center">
        <img src="{{ asset($profile_photo) }}" alt="Picture" class="img-fluid" width="100" height="100" />

        <h2 class="mt-3">{{ $user_name }}</h2>
        <p>Super Admin | {{ $email }}</p>

    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-center mb-4">
        <a href="#" class="btn btn-custom me-2">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
        <a href="{{ url('logout') }}" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection