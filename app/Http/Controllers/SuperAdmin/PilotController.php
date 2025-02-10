<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;

class PilotController extends Controller
{
    public function show($id)
    {
        $pilot = Pilot::with(['user', 'license', 'assignments.vehicle'])->findOrFail($id);


        return view('roles.super_admin.pilots_info.show', compact('pilot'));
    }

    public function updatePilotStatus(Request $request, $pilotID)
    {

        $request->validate([
            'status' => 'required|in:Active,Suspended,Deactivated'
        ]);


        $pilot = Pilot::findOrFail($pilotID);

        $pilot->account_status = $request->input('status');
        $pilot->save();
        $pilot->assignments->status = $request->input('status');
        $pilot->assignments->save();

        return redirect()->back()->with('success', 'Pilot status updated successfully.');
    }

    public function updatePilotApproval(Request $request, $pilotID)
    {
        $request->validate([
            'approval' => 'required|boolean'
        ]);


        $pilot = Pilot::findOrFail($pilotID);

        $pilot->approval = $request->input('approval');
        $pilot->save();

        return redirect()->back()->with('success', 'Pilot status updated successfully.');
    }

    public function updatePilotBackgroundCheckStatus(Request $request, $pilotID)
    {
        $request->validate([
            'background_check_status' => 'required|in:Pending,Passed,Failed'
        ]);

        $pilot = Pilot::findOrFail($pilotID);
        $pilot->background_check_status = $request->input('background_check_status');

        $pilot->save();

        if ($pilot->background_check_status === 'Passed') {
            return redirect()->route('super_admin-assign-pilot-to-vehicle.create');
        }
        return redirect()->back()->with('success', 'Pilot background check status updated successfully.');
    }
}
