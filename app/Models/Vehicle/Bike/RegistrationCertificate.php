<?php

namespace App\Models\Vehicle\Bike;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationCertificate extends Model
{

    protected $table = 'vehicle_registration_certificate';

    protected $fillable = [
        'vehicle_id',
        'registration_photo',
        'registration_number',
        'date',
        'vehicle_description',
        'vehicle_class',
        'color',
        'cc',
        'fuel',
        'seat',
        'engine_no',
        'chassis_no',
        'hire',
        'wheelbase',
        'unladen_weight',
        'laden_weight',
        'issuing_authority'
    ];
}
