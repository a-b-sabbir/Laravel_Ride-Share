@extends('layout.super_admin.layout')

@section('content')

<div class="container py-4">
  <!-- Page Header -->
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center">
      <img src="{{ asset($pilot->user->profile_photo) }}" alt="Pilot Image" class="rounded-circle" width="80" height="80">
      <div class="ms-3">
        <h3 class="mb-0">{{ $pilot->user->name }}</h3>
        <span class="text-muted">Status: {{ $pilot->account_status }}</span>
      </div>
    </div>
    <div>
      <button class="btn btn-primary">Edit Info</button>
      <button class="btn btn-success">Approve</button>
      <button class="btn btn-danger">Reject</button>
    </div>
  </div>

  <!-- Tabs -->
  <ul class="nav nav-tabs" id="pilotTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" href="#personal" role="tab">Personal Info</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="license-tab" data-bs-toggle="tab" href="#license" role="tab">License & Documents</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="vehicle-tab" data-bs-toggle="tab" href="#vehicle" role="tab">Vehicle Info</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="rides-tab" data-bs-toggle="tab" href="#rides" role="tab">Ride History</a>
    </li>
  </ul>

  <!-- Tab Content -->
  <div class="tab-content mt-4" id="pilotTabsContent">
    <!-- Personal Info Tab -->
    <div class="tab-pane fade show active" id="personal" role="tabpanel">

      <p><strong>Full Name:</strong> {{ $pilot->user->name }}</p>
      <p><strong>Email:</strong> {{ $pilot->user->email }}</p>
      <p><strong>Phone:</strong> {{ $pilot->user->phone_number }}</p>
      <p><strong>Address:</strong> {{ $pilot->address }}</p>
      <p><strong>NID:</strong> {{ $pilot->nid }}</p>
    </div>

    <!-- License & Documents Tab -->
    <div class="tab-pane fade" id="license" role="tabpanel">
      <div class="row">
        <!-- Driving License -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-header bg-primary text-white">Driving License</div>
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <img src="{{ $pilot->license->license_photo }}" alt="Driving License" class="img-thumbnail" style="width: 150px; height: 100px;">
                </div>
                <div class="ms-3">
                  <p><strong>License Number:</strong> {{ $pilot->license->license_number }}</p>
                  <p><strong>Issued Date:</strong> {{ $pilot->license->issue_date }}</p>
                  <p><strong>Expiry Date:</strong> {{ $pilot->license->expiry_date }}</p>
                  <p><strong>Issued By:</strong> {{ $pilot->license->issuing_authority }}</p>
                  <a href="{{ asset($pilot->license->license_photo) }}" target="_blank" class="btn btn-sm btn-primary mt-2">View Full</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- National ID -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-header bg-secondary text-white">National ID</div>
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <img src="/images/national_id.jpg" alt="National ID" class="img-thumbnail" style="width: 150px; height: 100px;">
                </div>
                <div class="ms-3">
                  <p><strong>ID Number:</strong> {{ $pilot->nid }}</p>
                  <a href="{{ asset($pilot->nid) }}" target="_blank" class="btn btn-sm btn-secondary mt-2">View Full</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Tax Token -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-header bg-success text-white">Tax Token</div>
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <img src="" alt="Tax Token" class="img-thumbnail" style="width: 150px; height: 100px;">
                </div>
                <div class="ms-3">
                  <p><strong>Tax Token Number:</strong> Sample</p>
                  <p><strong>Issued Date:</strong> 2023-06-01</p>
                  <p><strong>Expiry Date:</strong> 2024-06-01</p>
                  <a href="/images/tax_token.jpg" target="_blank" class="btn btn-sm btn-success mt-2">View Full</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Vehicle Info Tab -->
    <div class="tab-pane fade" id="vehicle" role="tabpanel">
      <div class="ms-3">
        <p><strong>Vehicle Number:</strong> {{ $pilot->assignments->vehicle->vehicle_number }}</p>
        <p><strong>Model:</strong> {{ $pilot->assignments->vehicle->model }}</p>
        <p><strong>Make:</strong> {{ $pilot->assignments->vehicle->make }}</p>
      </div>
    </div>

    <!-- Ride History Tab -->
    <div class="tab-pane fade" id="rides" role="tabpanel">
      <table class="table">
        <thead>
          <tr>
            <th>Ride ID</th>
            <th>Date</th>
            <th>Pickup Location</th>
            <th>Drop-off Location</th>
            <th>Earnings</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>R123</td>
            <td>2025-01-20</td>
            <td>City Center</td>
            <td>Airport</td>
            <td>25</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection