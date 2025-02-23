@extends('layout.super_admin.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reassign Pilot</div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form action="{{ route('super_admin.reassign_pilot_vehicle', $assigned->pilot->id) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <!-- Assigned Pilot Field (Dropdown shown initially) -->
                            <div id="pilot-field" class="form-group">
                                <label for="pilot">Assigned Pilot:</label>
                                <select id="pilot-dropdown" class="form-control">
                                    @foreach($pilots as $pilot)
                                    <option value="{{ $pilot->id }}"
                                        {{ $assigned->pilot->id == $pilot->id ? 'selected' : '' }}>
                                        {{ $pilot->user->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="vehicle_id">Select New Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                @foreach($vehicles as $vehicle)
                                @if($vehicle->approval === 'Approved')
                                <option value="{{ $vehicle->id }}"
                                    {{ $assigned->vehicle->id == $vehicle->id ? 'selected' : '' }}>
                                    {{ $assigned->vehicle->vehicle_number }}
                                </option> 
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Reassign</button>
                        <a href="{{ route('user-management') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection