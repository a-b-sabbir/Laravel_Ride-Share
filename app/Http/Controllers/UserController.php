<?php

namespace App\Http\Controllers;

use App\Models\Pilot\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\User;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $role = $user->role->name;
        $data['getRecord'] = $user;

        switch ($role) {
            case 'Super Admin':
                $data['user_name'] = $user->name;
                $data['total_super_admins'] = User::where('role_id', 1)->count();
                $data['total_admins'] = User::where('role_id', 2)->count();
                $data['total_sub_admins'] = User::where('role_id', 3)->count();
                $data['total_unassigned_pilots'] = Pilot::whereDoesntHave('assignments')->count();
                $data['total_unassigned_vehicles'] = Vehicle::whereDoesntHave('assignments')->count();
                $data['total_assigned_pilots'] = Pilot::whereHas('assignments')->count();
                $data['unassigned_pilots'] = Pilot::whereDoesntHave('assignments')->paginate(10);
                $data['assigned_pilots'] = Pilot::whereHas('assignments')->paginate(10);
                $data['total_pilots'] = Pilot::count();
                $data['active_pilots'] = Pilot::where('account_status', 'Active')->count();
                return view('roles.super_admin.user-management', $data);
        }

        return view('roles.super_admin.user-management', $data);
    }

    public function destroy($id)
    {
        dd('abc');
        $record = Pilot::findOrFail($id);
        $record->delete();

        return back()->with('success', 'Deleted successfully.');
    }
}
