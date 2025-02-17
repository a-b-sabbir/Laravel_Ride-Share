<?php

namespace App\Console\Commands;

use App\Models\Pilot;
use App\Models\PilotVehicleAssignment;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeactivateOverduePilots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pilots:deactivate-overdue';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivates pilots who have not paid on time and have no extra login days left';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now(); // Get today's date and time
        $assignedPilots = PilotVehicleAssignment::all();

        // Decrease the login_days by 1
        foreach ($assignedPilots as $assignedPilot) {
            if (!in_array($assignedPilot->status, ['Deactivated', 'Suspended'])) {
                if ($assignedPilot->login_days > 0) {
                    $assignedPilot->login_days -= 1;
                    $assignedPilot->pilot->payment_due_date = Carbon::parse($assignedPilot->pilot->payment_due_date)->subDay();
                    $assignedPilot->pilot->save();
                    $assignedPilot->save();
                }
            }
        }

        // Find pilots who:
        // - Have passed their payment due date
        // - Have no extra login days left
        // - Are not already deactivated
        $overduePilots = PilotVehicleAssignment::join('pilots', 'pilot_vehicle_assignments.pilot_id', '=', 'pilots.id')
            ->where('pilot_vehicle_assignments.login_days', '<=', 0)
            ->where('pilot_vehicle_assignments.status', '!=', 'Deactivated')
            ->whereDate('pilots.payment_due_date', '<=', $today)
            ->select('pilot_vehicle_assignments.id as assignment_id', 'pilots.id as pilot_id')
            ->get();

        foreach ($overduePilots as $pilot) {
            PilotVehicleAssignment::where('id', $pilot->assignment_id)->update(['status' => 'Deactivated']);
            Pilot::where('id', $pilot->pilot_id)->update(['account_status' => 'Deactivated']);
        }


        $this->info(count($overduePilots) . " pilots have been deactivated.");
    }
}
