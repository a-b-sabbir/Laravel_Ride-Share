<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use Illuminate\Http\Request;

class PilotController extends Controller
{
    public function show($id)
    {
        $pilot = Pilot::with(['user', 'license', 'assignments.vehicle'])->findOrFail($id);


        return view('sub_admin.pilots_info.show', compact('pilot'));
    }
}
