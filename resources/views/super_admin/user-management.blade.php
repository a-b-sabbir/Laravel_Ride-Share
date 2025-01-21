@extends('layout.super_admin.layout')

@section('content')

<div class="container mt-4">
    <h1>User Management</h1>
    <p class="lead">Manage the platform pilots and admins from here.</p>

    <!-- Users Summary (Pilots) -->
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Total Pilots</h5>
                    <p class="display-4 text-primary">{{ $total_pilots }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-success">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Active Pilots</h5>
                    <p class="display-4 text-success">{{ $active_pilots }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-danger">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">Suspended Pilots</h5>
                    <p class="display-4 text-danger">{{ $total_pilots - $active_pilots }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Summary -->
    <div class="row mt-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-danger">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">Total Super Admins</h5>
                    <p class="display-4 text-danger">{{ $total_super_admins }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Total Admins</h5>
                    <p class="display-4 text-primary">{{ $total_admins }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-success">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Total Sub Admins</h5>
                    <p class="display-4 text-success">{{ $total_sub_admins }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Unassigned Pilot List -->
    <div class="my-4">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Unassigned Pilots</h3>
                <a href="{{ url('chooseregistration') }}" class="btn btn-danger w-50 mt-auto" style="background-color: #5af8fc; border-color: #ffffff; color:black">
                    <i class="fas fa-cogs me-2"></i> Add New User
                </a>
            </div>
        </div>
        @if($unassigned_pilots)
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unassigned_pilots as $index => $record)
                    <tr>
                        <td>{{ (int) $index + 1 }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->user->email }}</td>
                        <td>{{ $record->user->phone_number }}</td>
                        <td>{{ $record->account_status }}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            No users available.
        </div>
        @endif
    </div>


    <!-- Assigned Pilot List -->
    <div class="my-4">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Assigned Pilots</h3>
                <a href="{{ url('chooseregistration') }}" class="btn w-50 mt-auto" style="background-color: #5af8fc; border-color: #ffffff; color: black;">
                    <i class="fas fa-cogs me-2"></i> Add New User
                </a>
            </div>
        </div>
        @if($assigned_pilots)
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assigned_pilots as $index => $record)
                    <tr>
                        <td>{{ (int) $index + 1 }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->user->email }}</td>
                        <td>{{ $record->user->phone_number }}</td>
                        <td>{{ $record->account_status }}</td>
                        <td>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-warning" role="alert">
            No users available.
        </div>
        @endif
    </div>
</div>

@endsection