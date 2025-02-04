<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Model;

class TaxToken extends Model
{
    protected $table = 'vehicle_tax_token';
    protected $fillable = [
        'vehicle_id',
        'tax_token_photo',
        'print_date',
        'chassis_number',
        'registration_number',
        'registration_date',
        'tax_token_number',
        'transaction_number',
        'eTracking_no',
        'issuing_bank_name',
        'issuing_branch',
        'issuing_teller_name',
        'chassis_number',
        'engine_number',
        'seats',
        'laden_weight',
        'owner_name',
        'father_or_husband_name',
        'previous_expiry_date',
        'issue_date',
        'tax_period_start',
        'tax_period_end',
        'principal_amount',
        'fine',
        'total_amount',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }
}
