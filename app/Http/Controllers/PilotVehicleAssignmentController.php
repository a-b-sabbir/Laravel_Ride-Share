<?php

namespace App\Http\Controllers;

use App\Models\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\Vehicle\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PilotVehicleAssignmentController extends Controller
{
    // Display form to assign a pilot to a vehicle
    public function create()
    {
        $pilots = Pilot::whereDoesntHave('assignments')->get(); // Get unassigned pilots
        $vehicles = Vehicle::whereDoesntHave('assignments')->get(); // Get unassigned vehicles

        return view('sub_admin.assignment', compact('pilots', 'vehicles'));
    }

    // Store a new pilot-vehicle assignment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pilot_id' => 'required|unique:pilot_vehicle_assignments,pilot_id',
            'vehicle_id' => 'required',
            'start_date' => 'required|date',
            'status' => 'required|in:Active,Suspended,Deactivated',
            'end_date' => 'nullable|date',
        ]);

        PilotVehicleAssignment::create([
            'pilot_id' => $validatedData['pilot_id'],
            'vehicle_id' => $validatedData['vehicle_id'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $request->end_date ?: null,
            'status' => $validatedData['status'],
            'assignment_notes' => $request->assignment_notes,
        ]);

        return redirect()->route('sub_admin.dashboard')->with('success', 'Pilot assigned successfully.');
    }

    // Update assignment status
    public function updateAssignmentStatus(Request $request, $assignmentId)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:Active,Suspended,Deactivated',
        ]);

        $assignment = PilotVehicleAssignment::findOrFail($assignmentId);
        $assignment->status = $validatedData['status'];

        if (in_array($validatedData['status'], ['Suspended', 'Deactivated'])) {
            $assignment->end_date = Carbon::now();
        }

        $assignment->save();

        return redirect()->route('sub_admin.dashboard')->with('success', 'Assignment status updated successfully.');
    }
}
