<?php

namespace App\Http\Controllers;

use App\Models\Pilot;
use App\Models\User;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role_id == '1') {
            $data['getRecord'] = $user;
            return view('super_admin.dashboard', $data);
        } elseif ($user->role_id == '2') {
            $data['getRecord'] = $user;
            return view('admin.dashboard', $data);
        } elseif ($user->role_id == '3') {
            $data = [
                'getRecord' => $user,
                'user_name' => session('user_name', $user->name),
                'pilots' => Pilot::all(),
                'unassigned_pilots' => Pilot::whereDoesntHave('assignments')->get(),
                'assigned_pilots' => Pilot::whereHas('assignments')->get(),
                'total_unassigned_pilots' => Pilot::whereDoesntHave('assignments')->count(),
                'total_unassigned_vehicles' => Vehicle::whereDoesntHave('assignments')->count(),
                'total_assigned_pilots' => Pilot::whereHas('assignments')->count(),
            ];
            return view('sub_admin.dashboard', $data)->with('success', 'Welcome to the dashboard!');
        } elseif ($user->role_id == '4') {
            $data['getRecord'] = $user;
            return view('pilot.dashboard', $data);
        }

        abort(403, 'Unauthorized action.');
    }
}
