<?php

namespace App\Http\Controllers\Pilot;

use App\Http\Controllers\Controller;
use App\Models\PilotVehicleAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        return view('roles.pilot.payment');
    }

    public function processPayment(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'pilot_assignment_id' => 'required|exists:pilot_vehicle_assignments,id',
            'paid_amount' => 'required|numeric|min:1',
        ]);

        // Retrieve the assigned pilot
        $assignedPilot = PilotVehicleAssignment::find($request->pilot_assignment_id);

        if (!$assignedPilot) {
            return response()->json(['error' => 'Pilot assignment ID not found'], 404);
        }

        $pilot = $assignedPilot->pilot;

        $pilot->update([
            'last_payment_date' => Carbon::now(),
            'paid_amount' => $request->paid_amount,
        ]);


        // Check if the paid amount qualifies for login days and extend payment_due_date
        if ($assignedPilot->vehicle->type == 'Car' && $request->paid_amount == 2500) {
            $assignedPilot->increment('login_days', 30);  // Increase login days by 30
            $pilot->update([
                'payment_due_date' => Carbon::parse($pilot->payment_due_date)->addDays(30)
            ]);
        } elseif ($assignedPilot->vehicle->type == 'Bike' && $request->paid_amount == 1000) {
            $assignedPilot->increment('login_days', 30);  // Increase login days by 30
            $pilot->update([
                'payment_due_date' => Carbon::parse($pilot->payment_due_date)->addDays(30)
            ]);
        }
        return redirect()->route('pilot.dashboard');
    }
}
