@extends('layout.super_admin.layout')

@section('content')
<div class="container py-4">
  <!-- Page Header -->
  <div class="d-flex align-items-center justify-content-between mb-4 p-3 shadow-sm bg-white rounded">
    <div class="d-flex align-items-center">
      <!-- Pilot Profile Image -->
      <img src="{{ asset('storage/' . $pilot->user->profile_photo) }}" alt="Pilot Image" class="rounded-circle border" width="80" height="80">

      <div class="ms-3">
        <h3 class="mb-1">{{ $pilot->user->name }}</h3>
        <span class="badge 
          {{ $pilot->account_status == 'Active' ? 'bg-success' : ($pilot->account_status == 'Suspended' ? 'bg-warning text-dark' : 'bg-danger') }}">
          {{ $pilot->account_status }}
        </span>
      </div>
    </div>

    <div class="d-flex align-items-center flex-wrap gap-3">
      <!-- Edit Info Button -->
      <a href="#" class="btn btn-outline-success d-flex align-items-center px-3">
        <i class="fas fa-edit me-2"></i> Edit Info
      </a>

      <!-- Approval Dropdown -->
      <form action="{{ route('pilot.approval', $pilot->id) }}" method="POST" class="d-flex align-items-center">
        @csrf
        <select name="approval" class="form-select form-select-sm" style="min-width: 130px;" onchange="this.form.submit()">
          <option value="1" {{ $pilot->approval == true ? 'selected' : '' }}>Approved</option>
          <option value="0" {{ $pilot->approval == false ? 'selected' : '' }}>Not Approved</option>
        </select>
      </form>

      <!-- Delete Assignment Button -->
      <form action="{{ route('delete_assignment', $pilot->assignments->id) }}" method="POST" class="d-flex align-items-center">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger d-flex align-items-center px-3"
          onclick="return confirm('Are you sure you want to delete this assignment?');">
          <i class="fas fa-trash-alt me-2"></i> Delete
        </button>
      </form>
    </div>

  </div>
</div>

<div class="container">
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
      <p><strong>Full Name:</strong> {{ $pilot->user->name ?? 'N/A' }}</p>
      <p><strong>Email:</strong> {{ $pilot->user->email ?? 'N/A' }}</p>
      <p><strong>Phone:</strong> {{ $pilot->user->phone_number ?? 'N/A' }}</p>
      <p><strong>Address:</strong> {{ $pilot->address ?? 'N/A' }}</p>
      <p><strong>NID:</strong> {{ $pilot->nid ?? 'N/A' }}</p>
    </div>

    <!-- License & Documents Tab -->
    <div class="tab-pane fade" id="license" role="tabpanel">
      <div class="row">
        <!-- Driving License -->
        @if($pilot->license)
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-header bg-primary text-white">Driving License</div>
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <img src="{{ asset('storage/' . $pilot->license->license_photo ?? '' )}}" alt="Driving License" class="img-thumbnail" style="width: 150px; height: 100px;">
                </div>
                <div class="ms-3">
                  <p><strong>License Number:</strong> {{ $pilot->license->license_number ?? 'N/A' }}</p>
                  <p><strong>Issued Date:</strong> {{ $pilot->license->issue_date ?? 'N/A' }}</p>
                  <p><strong>Expiry Date:</strong> {{ $pilot->license->expiry_date ?? 'N/A' }}</p>
                  <p><strong>Issued By:</strong> {{ $pilot->license->issuing_authority ?? 'N/A' }}</p>
                  <a href="{{ asset('storage/' . $pilot->license->license_photo ?? '') }}" target="_blank" class="btn btn-sm btn-primary mt-2">View Full</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif

        <!-- National ID -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-header bg-secondary text-white">National ID</div>
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div>
                  <img src="{{ asset('storage/' . $pilot->nid_image ?? '') }}" alt="National ID" class="img-thumbnail" style="width: 150px; height: 100px;">
                </div>
                <div class="ms-3">
                  <p><strong>ID Number:</strong> {{ $pilot->nid ?? 'N/A' }}</p>
                  <a href="{{ asset('storage/' . $pilot->nid_image ?? '') }}" target="_blank" class="btn btn-sm btn-secondary mt-2">View Full</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Vehicle Info Tab -->
    <div class="tab-pane fade" id="vehicle" role="tabpanel">
      @if($pilot->assignments && $pilot->assignments->vehicle)
      <div class="ms-3">
        <img src="{{ asset('storage/' . $pilot->assignments->vehicle->photo ?? 'N/A') }}"
          alt="Vehicle Photo"
          class="rounded-circle shadow" width="200" height="200" />
        <p><strong>Vehicle Type:</strong> {{ $pilot->assignments->vehicle->type ?? 'N/A' }}</p>
        <p><strong>Vehicle Number:</strong> {{ $pilot->assignments->vehicle->vehicle_number ?? 'N/A' }}</p>
        <p><strong>Model:</strong> {{ $pilot->assignments->vehicle->model ?? 'N/A' }}</p>
        <p><strong>Make:</strong> {{ $pilot->assignments->vehicle->make ?? 'N/A' }}</p>
      </div>

      <div class="ms-3">
        <p><strong>ID Number:</strong> {{ $pilot->nid ?? 'N/A' }}</p>
        <a href="{{ asset('storage/' . $pilot->assignments->vehicle->photo ?? 'N/A') }}" target="_blank" class="btn btn-sm btn-secondary mt-2">View Full</a>
      </div>
      @else
      <p>No vehicle assigned.</p>
      @endif
    </div>

    <!-- Ride History Tab -->
    <div class="tab-pane fade" id="rides" role="tabpanel">
      @if(isset($rides) && $rides->count() > 0)
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
          @foreach($rides as $ride)
          <tr>
            <td>{{ $ride->id }}</td>
            <td>{{ $ride->date }}</td>
            <td>{{ $ride->pickup_location }}</td>
            <td>{{ $ride->dropoff_location }}</td>
            <td>{{ $ride->earnings }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <p>No ride history available.</p>
      @endif
    </div>
  </div>

  @endsection

</div>