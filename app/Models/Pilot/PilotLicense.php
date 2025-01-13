<?php

namespace App\Models\Pilot;

use App\Models\Pilot;
use Illuminate\Database\Eloquent\Model;

class PilotLicense extends Model
{
    protected $fillable = [
        'pilot_id',
        'license_photo',
        'type',
        'name',
        'address',
        'birth_date',
        'blood_group',
        'father_or_husband_name',
        'license_number',
        'issue_date',
        'expiry_date',
        'ref_no',
        'issuing_authority',
    ];
    public function pilot()
    {
        return $this->belongsTo(Pilot::class);
    }
}
