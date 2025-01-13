<?php

namespace App\Models;

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
        'preferred_vehicle_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function license(){
        return $this->hasOne('PilotLicense::class');
    }
}
