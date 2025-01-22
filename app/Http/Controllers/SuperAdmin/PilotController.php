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


        return view('super_admin.pilots_info.show', compact('pilot'));
    }
}
