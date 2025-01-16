<?php

namespace App\Http\Controllers\Sub_Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Pilot;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {
        $totalAssignedDrivers = Pilot::where('assigned', true)->count();
        $availableVehicles = Vehicle::where('status', 'available')->count();

        return view('sub_admin/dashboard', compact('totalAssignedDrivers', 'availableVehicles', 'activeAssignments'));
    }
}
