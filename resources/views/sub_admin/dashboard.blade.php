@extends('layout.sub_admin.layout')

@section('content')

<!-- Header Section -->
<div class="header">
    <h1 class="text-primary">Welcome, {{ $user_name }}</h1>
    <p class="lead"><strong>{{ $getRecord->email }}</strong></p>
    <p class="lead">Here are some key metrics and controls for managing the platform:</p>
</div>

<!-- Summary Section (Improved Design) -->
<div class="row">
    <!-- Unassigned Pilots -->
    <div class="col-md-4">
        <div class="card border-primary summary-box">
            <div class="card-body">
                <h5 class="card-title text-danger">Unassigned Pilots</h5>
                <p class="card-text text-danger display-4">{{ $total_unassigned_pilots }}</p>
                @if($total_unassigned_pilots > 0)
                <a href="{{ route('assign-pilot-to-vehicle.create') }}" class="btn btn-danger btn-block">Assign Pilot</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Unassigned Vehicles -->
    <div class="col-md-4">
        <div class="card border-success summary-box">
            <div class="card-body">
                <h5 class="card-title text-success">Unassigned Vehicles</h5>
                <p class="card-text text-success display-4">{{ $total_unassigned_vehicles }}</p>
            </div>
        </div>
    </div>

    <!-- Assigned Pilots -->
    <div class="col-md-4">
        <div class="card border-primary summary-box">
            <div class="card-body">
                <h5 class="card-title text-primary">Assigned Pilots</h5>
                <p class="card-text text-primary display-4">{{ $total_assigned_pilots }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Unassigned Pilots Section with Assign Button -->
<div class="my-4">
    <h3>Unassigned Pilots</h3>
    @if($unassigned_pilots->isEmpty())
    <div class="alert alert-warning" role="alert">
        No unassigned pilots available.
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Pilot Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unassigned_pilots as $index => $unassigned_pilot)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $unassigned_pilot->user->name }}</td>
                    <td>{{ $unassigned_pilot->user->phone_number }}</td>
                    <td>{{ $unassigned_pilot->user->email }}</td>

                    <td>
                        <a href="{{ route('assign-pilot-to-vehicle.create', ['pilot_id' => $unassigned_pilot->id]) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-user-check"></i> Assign
                        </a>
                        <a href="{{ route('pilot.show', ['id' => $unassigned_pilot->id]) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-user-check"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<!-- Assigned Pilots Section -->
<div class="my-4">
    <h3>Assigned Pilots</h3>
    @if($assigned_pilots->isEmpty())
    <div class="alert alert-info" role="alert">
        No assigned pilots available.
    </div>
    @else
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Pilot Name</th>
                    <th>Vehicle Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assigned_pilots as $index => $assigned_pilot)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $assigned_pilot->pilot->user->name }}</td>
                    <td>{{ $assigned_pilot->vehicle->vehicle_number }}</td>
                    <td>{{ $assigned_pilot->status }}</td>
                    <td>
                        <a href="{{ route('pilot.show', ['id' => $assigned_pilot->id]) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-user-check"></i> View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>


<div class="text-center my-4">
    <a href="{{ route('assign-pilot-to-vehicle.create') }}" class="btn btn-primary">Assign Pilot to Vehicle</a>
    <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>
</div>

@endsection