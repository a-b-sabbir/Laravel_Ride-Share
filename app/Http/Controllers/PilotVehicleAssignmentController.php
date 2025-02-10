<?php

namespace App\Http\Controllers;

use App\Models\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\Vehicle\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PilotVehicleAssignmentController extends Controller
{
    // Display form to assign a pilot to a vehicle
    public function create()
    {

        $pilots = Pilot::whereDoesntHave('assignments')->get(); // Get unassigned pilots
        $vehicles = Vehicle::whereDoesntHave('assignments')->get(); // Get unassigned vehicles


        // Dynamically determine the view based on the role
        $role = Auth::user()->role->name;

        switch ($role) {
            case 'Super Admin':
                return view('roles.super_admin.assignment', compact('pilots', 'vehicles'));
            case 'Admin':
                return view('roles.admin.assignment', compact('pilots', 'vehicles'));
            case 'Sub-Admin':
                return view('roles.sub_admin.assignment', compact('pilots', 'vehicles'));
            default:
                abort(403, 'Unauthorized action.');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pilot_id' => 'required|unique:pilot_vehicle_assignments,pilot_id',
            'vehicle_id' => 'required',
            'start_date' => 'required|date',
            'status' => 'required|in:Active,Suspended,Deactivated',
            'end_date' => 'nullable|date',
        ]);
        $user = Auth::user();

        DB::beginTransaction();

        try {
            // Create PilotVehicleAssignment
            PilotVehicleAssignment::create([
                'pilot_id' => $validatedData['pilot_id'],
                'vehicle_id' => $validatedData['vehicle_id'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $request->end_date ?: null,
                'status' => $validatedData['status'],
                'assignment_notes' => $request->assignment_notes,
                'admin_id' => $user->id,
                'login_days' => 30,  // This is for the first 30 free days
            ]);

            // Find the pilot and update the payment_due_date
            $pilot = Pilot::findOrFail($validatedData['pilot_id']);

            // Set the payment_due_date to 30 days from now
            $pilot->payment_due_date = Carbon::now()->addDays(30);
            $pilot->approval_date = now();  // Set the approval date

            // Ensure the approval field is set to true if it's false
            if ($pilot->approval === false) {
                $pilot->approval = true;
            }

            // Save the pilot details
            $pilot->save();

            // Commit transaction
            DB::commit();

            // Redirect based on the user's role
            $role = Auth::user()->role->name;
            switch ($role) {
                case 'Super Admin':
                    return redirect()->route('super_admin.dashboard')->with('success', 'Pilot assigned successfully.');
                case 'Admin':
                    return redirect()->route('roles.admin.dashboard')->with('success', 'Pilot assigned successfully');
                case 'Sub-Admin':
                    return redirect()->route('roles.sub_admin.dashboard')->with('success', 'Pilot assigned successfully');
                default:
                    abort(403, 'Unauthorized Action');
            }
        } catch (\Exception $e) {
            // If anything fails, roll back the transaction
            DB::rollBack();
            // Log or display error message
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
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

        return redirect()->route('roles.sub_admin.dashboard')->with('success', 'Assignment status updated successfully.');
    }
}
