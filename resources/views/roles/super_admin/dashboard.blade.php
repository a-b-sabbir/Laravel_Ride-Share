@extends('layout.super_admin.layout')

@section('content')
<h1>Welcome, {{ $getRecord->name }}!</h1>
<p class="lead">Here are some key metrics and controls for managing the platform:</p>

<div class="row">

    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Passengers</h5>
                    <p class="card-text">{{ $total_passengers }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Active Rides</h5>
                    <p class="card-text">0</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Complaints</h5>
                    <p class="card-text">0</p>
                </div>
            </div>
        </div>

        <!-- Average Feedback Rating -->
        <div class="col-md-3">
            <div class="card bg-secondary text-white mb-3">
                <div class="card-body">
                    <h5 class="card-title">Average Rating</h5>
                    <p class="card-text">0/5</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <!-- Total Active Pilots -->
        <div class="col-md-3">
            <div class="card bg-warning text-dark mt-3">
                <div class="card-body">
                    <h5 class="card-title">Total Suspended Pilots</h5>
                    <p class="card-text">{{ $total_suspended_pilots }}</p>
                </div>
            </div>
        </div>

        <!-- Total Active Pilots -->
        <div class="col-md-3">
            <div class="card bg-warning text-dark mt-3">
                <div class="card-body">
                    <h5 class="card-title">Total Active Pilots</h5>
                    <p class="card-text">{{ $total_active_pilots }}</p>
                </div>
            </div>
        </div>

        <!-- Total Unassigned Pilots -->
        <div class="col-md-3">
            <a href="{{ route   ('super_admin-assign-pilot-to-vehicle.create') }}" class="text-decoration-none">
                <div class="card bg-danger text-white mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Unassigned Pilots</h5>
                        <p class="card-text">{{ $total_unassigned_pilots }}</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Unassigned Pilots -->
        <div class="col-md-3">
            <div class="card bg-success text-white mt-3">
                <div class="card-body">
                    <h5 class="card-title">Total Assigned Pilots</h5>
                    <p class="card-text">{{ $total_assigned_pilots }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card bg-success text-white text-center mt-3">
                <div class="card-body">
                    <h5>Total Revenue</h5>
                    <h3>TK 00000</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-warning text-center mt-3">
                <div class="card-body">
                    <h5>Pending Payments</h5>
                    <h3>TK 00000</h3>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection