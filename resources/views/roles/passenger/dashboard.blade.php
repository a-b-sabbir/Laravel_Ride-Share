<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .card {
            border-radius: 10px;
        }

        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="dashboard-header text-center mb-4">
            <h1>Welcome, {{ $user_name }}</h1>
            <p>Here's an overview of your account</p>
        </div>

        <div class="row g-4">
            <!-- Profile Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Profile Info
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $getRecord->name }}</p>
                        <p><strong>Email:</strong> {{ $getRecord->email }}</p>
                        <p><strong>Country:</strong> {{ $passenger->country }}</p>
                        <p><strong>Address:</strong> {{ $passenger->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Account Stats
                    </div>
                    <div class="card-body">
                        <p><strong>Account Status:</strong> {{ $passenger->account_status }}</p>
                        <p><strong>Total Rides:</strong> {{ $passenger->no_of_rides }}</p>
                        <p><strong>Rating:</strong> {{ $passenger->rating }}/5</p>
                        <p><strong>Positive Feedback:</strong> {{ $passenger->positive_feedback_percentage }}%</p>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact Card -->
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        Emergency Contact
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $passenger->emergency_contact_name ?? 'N/A' }}</p>
                        <p><strong>Number:</strong> {{ $passenger->emergency_contact_number ?? 'N/A' }}</p>
                        <p><strong>Relation:</strong> {{ $passenger->relation_with_emergency_contact ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Activity
                    </div>
                    <div class="card-body">
                        <p><strong>Last Trip Completed:</strong> {{ $passenger->last_trip_completed_at ?? 'No trips yet' }}</p>
                        <p><strong>Total Distance Driven:</strong> {{ $passenger->total_distance_driven }} km</p>
                        <p><strong>No. of Complaints:</strong> {{ $passenger->no_of_complaints }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="text-center my-4">
        <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>
    </div>


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>