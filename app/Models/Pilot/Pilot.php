<?php

namespace App\Models\Pilot;

use App\Models\Pilot\PilotLicense;
use App\Models\PilotVehicleAssignment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
    protected $fillable = [
        'user_id',
        'nid',
        'nid_image',
        'address',
        'emergency_contact_name',
        'emergency_contact_number',
        'relation_with_emergency_contact',
        'preferred_shift',
        'registration_step',
        'last_payment_date',
        'payment_due_date',
        'paid_amount',
        'login_days',
        'account_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function license()
    {
        return $this->hasOne(PilotLicense::class);
    }

    public function assignments()
    {
        return $this->hasOne(PilotVehicleAssignment::class);
    }
}
