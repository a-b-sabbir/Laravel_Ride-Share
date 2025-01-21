@extends('layout.super_admin.layout')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <center>Assign A Pilot</center>
                    </h4>
                    <form action="{{ route('assign-pilot-to-vehicle.store') }}" method="POST">
                        @csrf

                        <!-- Pilot Dropdown -->
                        <div class="form-group">
                            <label for="pilot_id">Pilot</label>
                            <select name="pilot_id" id="pilot_id" class="form-control" required>
                                <option value="" disabled selected>Select a pilot</option>
                                @foreach($pilots as $pilot)
                                <option value="{{ $pilot->id }}">{{ $pilot->user->name }}- {{ $pilot->nid }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Vehicle Dropdown -->
                        <div class="form-group">
                            <label for="vehicle_id">Vehicle</label>
                            <select name="vehicle_id" id="vehicle_id" class="form-control" required>
                                <option value="" disabled selected>Select a vehicle</option>
                                @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input
                                type="datetime-local"
                                name="start_date"
                                id="start_date"
                                class="form-control"
                                value="{{ old('start_date', date('Y-m-d\TH:i')) }}"
                                required>
                        </div>

                        <!-- End Date -->
                        <div class="form-group">
                            <label for="end_date">End Date (Optional)</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="Active" selected>Active</option>
                                <option value="Suspended">Suspended</option>
                                <option value="Deactivated">Deactivated</option>
                            </select>
                        </div>

                        <!-- Assignment Notes -->
                        <div class="form-group">
                            <label for="assignment_notes">Assignment Notes</label>
                            <textarea name="assignment_notes" id="assignment_notes" class="form-control">{{ old('assignment_notes') }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Assignment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@endsection