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
        'assignment_notes'
    ];
    public function pilot()
    {
        return $this->belongsTo(Pilot::class, 'pilot_id');
    }

    // Define the relationship with the Vehicle model
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
