<?php

namespace App\Models\Vehicle;

use App\Models\PilotVehicleAssignment;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'type',
        'photo',
        'vehicle_number',
        'brand',
        'make',
        'model'
    ];

    public function assignments()
    {
        return $this->hasOne(PilotVehicleAssignment::class, 'vehicle_id');
    }
}
