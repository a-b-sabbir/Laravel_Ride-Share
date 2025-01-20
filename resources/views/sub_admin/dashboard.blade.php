@extends('layout.sub_admin.layout')

@section('content')


<!-- Header Section -->
<div class="header">
    <h1 class="text-primary">Sub-Admin Dashboard</h1>
    <p class="lead">Welcome, <strong>{{ $user_name }}</strong></p>
    <p>Email: <strong>{{ $getRecord->email }}</strong></p>
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

<!-- Pilots Section -->
<div class="my-4">
    <h3>Assigned Pilots</h3>
    @if($assigned_pilots->isEmpty())
    <p>No assigned pilots available.</p>
    @else
    <ul class="list-group">
        @foreach($assigned_pilots as $index => $assigned_pilot)
        <li class="list-group-item">
            <strong>{{ $index + 1 }}. {{ $assigned_pilot->user->name }}</strong>
        </li>
        @endforeach
    </ul>
    @endif
</div>

<!-- Unassigned Pilots Section with Assign Button -->
<div class="my-4">
    <h3>Unassigned Pilots</h3>
    @if($unassigned_pilots->isEmpty())
    <p>No unassigned pilots available.</p>
    @else
    <ul class="list-group">
        @foreach($unassigned_pilots as $index => $unassigned_pilot)
        <li class="list-group-item d-flex justify-content-between">
            <span><strong>{{ $index + 1 }}. {{ $unassigned_pilot->user->name }}</strong></span>
            <a href="{{ route('assign-pilot-to-vehicle.create', ['pilot_id' => $unassigned_pilot->id]) }}" class="btn btn-primary btn-sm">Assign</a>
        </li>
        @endforeach
    </ul>
    @endif
</div>

<!-- Assigned Pilots Section -->
<div class="my-4">
    <h3>Assigned Pilots</h3>
    @if($assigned_pilots->isEmpty())
    <p>No assigned pilots available.</p>
    @else
    <ul class="list-group">
        @foreach($assigned_pilots as $index => $assigned_pilot)
        <li class="list-group-item">
            <strong>{{ $index + 1 }}. {{ $assigned_pilot->user->name }}</strong>
        </li>
        @endforeach
    </ul>
    @endif
</div>

<!-- Action Buttons -->
<div class="text-center my-4">
    <a href="{{ route('assign-pilot-to-vehicle.create') }}" class="btn btn-primary">Assign Pilot to Vehicle</a>
    <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>
</div>

@endsection