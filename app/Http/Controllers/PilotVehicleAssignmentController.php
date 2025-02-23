<?php

namespace App\Http\Controllers;

use App\Models\Pilot\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\Referral;
use App\Models\Vehicle\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            PilotVehicleAssignment::create([
                'pilot_id' => $validatedData['pilot_id'],
                'vehicle_id' => $validatedData['vehicle_id'],
                'start_date' => $validatedData['start_date'],
                'end_date' => $request->end_date ?: null,
                'status' => $validatedData['status'],
                'assignment_notes' => $request->assignment_notes,
                'admin_id' => $user->id
            ]);

            $referrer_pilot = Pilot::findOrFail($validatedData['pilot_id']);

            // Referrer
            $referrer_pilot->user->referral_code = strtoupper(Str::random(8));

            $referrer_pilot->user->save();

            // Set the payment_due_date to 30 days from now
            $referrer_pilot->payment_due_date = Carbon::now()->addDays(30);
            $referrer_pilot->login_days = 30;
            $referrer_pilot->approval_date = now();

            // Ensure the approval field is set to true if it's false
            if ($referrer_pilot->approval === false) {
                $referrer_pilot->approval = true;
            }


            // Referred
            $referred_user_id = $referrer_pilot->user->id;

            $vehicle = Vehicle::findOrFail($validatedData['vehicle_id']);
            $vehicle_type = $vehicle->type;

            // Referred
            $referral = Referral::where('referred_user_id', $referred_user_id)->first();

            if ($referral) {
                if ($vehicle_type == 'Car') {
                    $referral->update([
                        'referred_user_type' => $vehicle_type,
                        'status' => 'Successful',
                        'rewards_given' => true
                    ]);
                } elseif ($vehicle_type == 'Bike') {
                    $referral->update([
                        'referred_user_type' => $vehicle_type,
                        'status' => 'Successful',
                        'rewards_given' => true
                    ]);
                } else {
                    $referral->update([
                        'referred_user_type' => 'Passenger',
                        'status' => 'Successful',
                        'rewards_given' => true
                    ]);
                }


                $referrer = $referral->referrer_user_id;


                $referrerPilot = Pilot::where('user_id', $referrer)->first();


                if ($referrerPilot) {

                    if ($vehicle_type == 'Car') {
                        $referrerPilot->increment('login_days', 10);  // Adding 10 extra days
                        $referrerPilot->update([
                            'payment_due_date' => Carbon::parse($referrerPilot->payment_due_date)->addDays(10)  // Adding 10 extra days
                        ]);
                    } elseif ($vehicle_type == 'Bike') {
                        $referrerPilot->increment('login_days', 4);  // Adding 4 extra days
                        $referrerPilot->update([
                            'payment_due_date' => Carbon::parse($referrerPilot->payment_due_date)->addDays(4)  // Adding 4 extra days
                        ]);
                    }
                }
            }

            $referrer_pilot->save();

            DB::commit();


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

            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function deleteAssignment($assignedID)
    {
        $assigned = PilotVehicleAssignment::findOrFail($assignedID);

        if ($assigned->pilot) {
            $assigned->pilot->update(['account_status' => 'Suspended']);
        }

        $assigned->delete();


        return redirect()->route('user-management')->with('success', 'Assignment deleted successfully.');
    }
}
