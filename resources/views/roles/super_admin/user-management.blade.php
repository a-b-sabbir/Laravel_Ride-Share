@extends('layout.super_admin.layout')

@section('content')

<div class="container mt-4">
    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1>User Management</h1>
                <p class="lead">Manage the platform pilots and admins from here.</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="/chooseregistration" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus"></i> Add New User
                </a>
            </div>
        </div>
    </div>



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
            </div>
        </div>
        @if($unassigned_pilots)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Assignment ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Wallet</th>
                        <th>Login Days</th>
                        <th>Payment Due Date</th>
                        <th>Status</th>
                        <th>Background Check</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($unassigned_pilots as $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->user->email }}</td>
                        <td>{{ $record->user->phone_number }}</td>
                        <td>{{ $record->wallet_balance }}</td>
                        <td>{{ $record->login_days }}</td>
                        <td>{{ $record->payment_due_date }}</td>
                        <td>
                            <form action="{{ route('unassigned_pilot.updateStatus', $record->id) }}" method="POST" id="statusForm">
                                @csrf
                                <div class="form-group">
                                    <select name="status" class="form-control" id="status" onchange="this.form.submit()">
                                        <option value="Active" {{ $record->account_status == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Suspended" {{ $record->account_status == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                        <option value="Deactivated" {{ $record->account_status == 'Deactivated' ? 'selected' : '' }}>Deactivated</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('pilot.backgroundCheckStatus', $record->id) }}" method="POST" id="statusForm">
                                @csrf
                                <div class="form-group">
                                    <select name="background_check_status" class="form-control" id="background_check_status" onchange="this.form.submit()">

                                        <option value="Pending" {{ $record->background_check_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Passed" {{ $record->background_check_status == 'Passed' ? 'selected' : '' }}>Passed</option>
                                        <option value="Failed" {{ $record->background_check_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('unassigned-pilot.show', $record->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-user-check"></i> View
                            </a>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($unassigned_pilots->count() > 9)
            <div class="d-flex justify-content-center">
                {{ $unassigned_pilots->links('pagination::bootstrap-5') }}
            </div>
            @endif

        </div>
        @else
        <div class="alert alert-warning" role="alert">
            No users available.
        </div>
        @endif
    </div>


    <!-- Unassigned Pilot List -->

    <div class="my-4">
        <div class="row">
            <div class="d-flex justify-content-between align-items-center">
                <h3>Assigned Pilots</h3>
            </div>
        </div>

        @if($assigned_pilots)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Assignment ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Wallet</th>
                        <th>Login Days</th>
                        <th>Payment Due Date</th>
                        <th>Status</th>
                        <th>Vehicle Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assigned_pilots as $index => $record)
                    <tr>
                        <td>{{ $record->id }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->user->email }}</td>
                        <td>{{ $record->user->phone_number }}</td>
                        <td>{{ $record->wallet_balance }}</td>
                        <td>{{ $record->login_days }}</td>
                        <td>{{ $record->payment_due_date }}</td>
                        <td>
                            <form action="{{ route('pilot.updateStatus', $record->id) }}" method="POST" id="statusForm">
                                @csrf
                                <div class="form-group">
                                    <select name="status" class="form-control" id="status" onchange="this.form.submit()">
                                        <option value="Active" {{ $record->assignments->status == 'Active' ? 'selected' : '' }}>Active</option>
                                        <option value="Suspended" {{ $record->assignments->status == 'Suspended' ? 'selected' : '' }}>Suspended</option>
                                        <option value="Deactivated" {{ $record->assignments->status == 'Deactivated' ? 'selected' : '' }}>Deactivated</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td>{{ $record->assignments->vehicle->vehicle_number }}</td>
                        <td>
                            <a href="{{ route('assigned-pilot.show', $record->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-user-check"></i> View
                            </a>
                            <a href="" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection