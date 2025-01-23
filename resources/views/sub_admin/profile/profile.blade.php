@extends('layout.sub_admin.layout')

@section('content')
<div class="container mt-5">
    <!-- Profile Header -->
    <div class="profile-header text-center">
        <div class="profile-photo">
            <img src="{{ asset($profile_photo) }}" alt="Profile Picture" class="rounded-circle shadow" width="120" height="120" />
        </div>
        <h2 class="mt-3">{{ $user_name }}</h2>
        <p class="text-muted">Sub Admin | {{ $email }}</p>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-center mt-4">
        <a href="#" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Profile
        </a>
        <a href="{{ url('logout') }}" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>
@endsection