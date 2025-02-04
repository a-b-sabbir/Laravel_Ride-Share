<?php

namespace App\Models\Vehicle;

use App\Models\PilotVehicleAssignment;
use App\Models\Vehicle\Bike\RegistrationCertificate;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'type',
        'photo',
        'vehicle_number',
        'brand',
        'make',
        'model',
        'registration_step'
    ];

    public function assignments()
    {
        return $this->hasOne(PilotVehicleAssignment::class, 'vehicle_id');
    }

    public function registrationCertificate()
    {
        return $this->hasOne(RegistrationCertificate::class, 'vehicle_id');
    }
    public function taxToken()
    {
        return $this->hasOne(TaxToken::class);
    }
}
