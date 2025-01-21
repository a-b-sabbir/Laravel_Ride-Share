@extends('layout.super_admin.layout')

@section('content')
<div class="container mt-5">
    <!-- Page Header -->
    <div class="settings-header text-center mb-5">
        <h2>Account Settings</h2>
        <p class="text-muted">Manage your personal information and platform preferences.</p>
    </div>

    <!-- Settings Options -->
    <div class="row">
        <!-- Profile Settings -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-light rounded" style="min-height: 250px;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-circle fa-2x me-3 text-primary"></i>
                        <h5 class="card-title">Profile Settings</h5>
                    </div>
                    <p class="card-text text-muted">Update your profile information and avatar.</p>
                    <a href="{{ url('profile/edit') }}" class="btn btn-outline-primary w-100 mt-auto">
                        <i class="fas fa-edit me-2"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-light rounded" style="min-height: 250px;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-key fa-2x me-3 text-success"></i>
                        <h5 class="card-title">Change Password</h5>
                    </div>
                    <p class="card-text text-muted">Update your password to enhance security.</p>
                    <a href="{{ url('password/change') }}" class="btn btn-outline-success w-100 mt-auto">
                        <i class="fas fa-lock me-2"></i> Change Password
                    </a>
                </div>
            </div>
        </div>

        <!-- Notification Settings -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-light rounded" style="min-height: 250px;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bell fa-2x me-3 text-warning"></i>
                        <h5 class="card-title">Notification Settings</h5>
                    </div>
                    <p class="card-text text-muted">Manage how you receive notifications from the platform.</p>
                    <a href="{{ url('notifications/settings') }}" class="btn btn-outline-warning w-100 mt-auto">
                        <i class="fas fa-sliders-h me-2"></i> Configure Notifications
                    </a>
                </div>
            </div>
        </div>

        <!-- Admin Management (Super Admin Only) -->
        @if(Auth::user()->role == 'super_admin')
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-light rounded" style="min-height: 250px;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-users-cog fa-2x me-3 text-info"></i>
                        <h5 class="card-title">Manage Admins</h5>
                    </div>
                    <p class="card-text text-muted">Manage admin accounts and set permissions.</p>
                    <a href="{{ url('admin/manage') }}" class="btn btn-outline-info w-100 mt-auto">
                        <i class="fas fa-users me-2"></i> Manage Admins
                    </a>
                </div>
            </div>
        </div>

        <!-- Platform Settings (Super Admin Only) -->
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-light rounded" style="min-height: 250px;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-cogs fa-2x me-3 text-danger"></i>
                        <h5 class="card-title">Platform Settings</h5>
                    </div>
                    <p class="card-text text-muted">Configure platform-wide settings and permissions.</p>
                    <a href="{{ url('platform/settings') }}" class="btn btn-outline-danger w-100 mt-auto">
                        <i class="fas fa-cogs me-2"></i> Configure Platform
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection