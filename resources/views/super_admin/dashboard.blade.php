@extends('layout.super_admin.layout')
@section('content')

<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="sidebar-heading">Super Admin Dashboard</div>
        <ul class="list-group list-group-flush">
            <a href="{{ route('super_admin.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="#" class="list-group-item list-group-item-action">User Management</a>
            <a href="#" class="list-group-item list-group-item-action">Rides</a>
            <a href="#" class="list-group-item list-group-item-action">Payments</a>
            <a href="#" class="list-group-item list-group-item-action">Analytics</a>
            <a href="#" class="list-group-item list-group-item-action">Settings</a>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container-fluid">
                <button class="btn btn-secondary" id="menu-toggle">
                    <i class="bi bi-list-nested"></i>
                </button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Notifications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('profile') }}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('logout') }}">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            <h1>Welcome, Super Admin!</h1>
            <p class="lead">Here are some key metrics and controls for managing the platform:</p>

            <div class="row">
                <div class="col-md-3">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text">{{ $total_users }}</p>
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

            <div class="mt-4">
                <h5>Analytics</h5>
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle Sidebar Functionality
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('wrapper').classList.toggle('toggled');
    });

    // Analytics
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Revenue (TK)',
                data: [12000, 19000, 30000, 50000, 70000, 100000],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        }
    });
</script>

@endsection