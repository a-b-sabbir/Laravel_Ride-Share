<?php

namespace App\Models\Vehicle\Car;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Model;

class Fitness extends Model
{

    protected $table = 'vehicle_fitness';

    protected $fillable = [
        'vehicle_id',
        'fitness_photo',
        'vehicle_identity_no',
        'user_identity_no',
        'registration_no',
        'certificate_no',
        'vehicle_description',
        'chassis_no',
        'engine_no',
        'hired',
        'seats',
        'cylinder',
        'cc',
        'unladen_weight',
        'laden_weight',
        'color',
        'number_of_tyres',
        'size_of_tyre',
        'dimension_length',
        'dimension_width',
        'dimension_height',
        'front_overhang',
        'back_overhang',
        'name',
        'husband_or_father_name',
        'address',
        'TIN',
        'issue_date',
        'fitness_period_start',
        'fitness_period_end',
        'inspector_name',
        'inspector_designation',
        'inspector_area',
        'inspection_date'
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
