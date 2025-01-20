<?php

namespace App\Models\Passenger;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = [
        'user_id',
        'country',
        'address',
        'emergency_contact_name',
        'emergency_contact_number',
        'relation_with_emergency_contact',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
