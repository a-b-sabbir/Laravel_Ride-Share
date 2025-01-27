<?php

namespace App\Http\Controllers;

use App\Models\Passenger\Passenger;
use App\Models\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\User;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();  // Get the authenticated user
        $role = $user->role->name;  // Fetch the role name from the relationship
        $data['getRecord'] = $user;  // Pass user data to the view


        switch ($role) {
            case 'Super Admin':
                $data['total_passengers'] = Passenger::count();
                $data['total_unassigned_pilots'] = Pilot::whereDoesntHave('assignments')->count();
                $data['total_assigned_pilots'] = Pilot::whereHas('assignments')->count();
                $data['total_active_pilots'] = Pilot::where('account_status', 'Active')->count();
                $data['total_suspended_pilots'] = Pilot::where('account_status', 'Suspended')->count();
                return view('roles.super_admin.dashboard', $data);

            case 'Admin':

                $data['user_name'] = session('user_name', $user->name);
                $data['pilots'] = Pilot::all();
                $data['unassigned_pilots'] = Pilot::whereDoesntHave('assignments')->get();
                $data['assigned_pilots'] = PilotVehicleAssignment::all();
                $data['total_unassigned_pilots'] = Pilot::whereDoesntHave('assignments')->count();
                $data['total_unassigned_vehicles'] = Vehicle::whereDoesntHave('assignments')->count();
                $data['total_assigned_pilots'] = Pilot::whereHas('assignments')->count();

                return view('roles.admin.dashboard', $data);

            case 'Sub-Admin':
                
                $data['user_name'] = session('user_name', $user->name);
                $data['pilots'] = Pilot::all();
                $data['unassigned_pilots'] = Pilot::whereDoesntHave('assignments')->get();
                $data['assigned_pilots'] = PilotVehicleAssignment::all();
                $data['total_unassigned_pilots'] = Pilot::whereDoesntHave('assignments')->count();
                $data['total_unassigned_vehicles'] = Vehicle::whereDoesntHave('assignments')->count();
                $data['total_assigned_pilots'] = Pilot::whereHas('assignments')->count();

                return view('roles.sub_admin.dashboard', $data)->with('success', 'Welcome to the dashboard!');

            case 'Pilot':
                return view('roles.pilot.dashboard', $data);

            case 'Passenger':

                $data['user_name'] = session('user_name', $user->name);
                $data['passenger'] = Passenger::where('user_id', Auth::id())->firstOrFail();

                return view('roles.passenger.dashboard', $data);

            default:
                abort(403, 'Unauthorized action.');
        }
    }
}
