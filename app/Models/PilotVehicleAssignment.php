<?php

namespace App\Models;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Model;

class PilotVehicleAssignment extends Model
{
    protected $fillable = [
        'pilot_id',
        'vehicle_id',
        'start_date',
        'end_date',
        'status',
        'assignment_notes',
        'admin_id'
    ];
    public function pilot()
    {
        return $this->belongsTo(Pilot::class);
    }

    // Define the relationship with the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
