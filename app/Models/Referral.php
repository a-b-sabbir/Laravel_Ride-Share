<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'referrer_user_id',
        'referred_user_id',
        'referred_user_type',
        'status',
        'rewards_given'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
