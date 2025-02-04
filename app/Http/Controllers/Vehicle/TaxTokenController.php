<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\TaxToken;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use thiagoalessio\TesseractOCR\TesseractOCR;

class TaxTokenController extends Controller
{

    public function showTaxTokenForm($vehicleID)
    {
        return view('vehicle.tax-token-form', compact('vehicleID'));
    }

    public function uploadTaxToken(Request $request)
    {

        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'tax_token_photo' => 'required',
            'print_date' => 'required|date',
            'registration_number' => 'required',
            'registration_date' => 'required|date',
            'tax_token_number' => 'required|unique:vehicle_tax_token,tax_token_number',
            'transaction_number' => 'required|unique:vehicle_tax_token,transaction_number',
            'eTracking_no' => 'required|string',
            'issuing_bank_name' => 'required|string',
            'issuing_branch' => 'required|string',
            'issuing_teller_name' => 'required|string',
            'chassis_number' => 'required|string|unique:vehicle_tax_token,chassis_number',
            'engine_number' => 'required|string|unique:vehicle_tax_token,engine_number',
            'seats' => 'required|integer|min:1',
            'laden_weight' => 'required|numeric|min:0',
            'owner_name' => 'required|string',
            'father_or_husband_name' => 'required|string',
            'previous_expiry_date' => 'required|date',
            'issue_date' => 'required|date',
            'tax_period_start' => 'required|date',
            'tax_period_end' => 'required|date|after:tax_period_start',
            'principal_amount' => 'required|numeric|min:0',
            'fine' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $vehicle = Vehicle::findOrFail($validatedData['vehicle_id']);


        $taxTokenPhotoPath = $request->file('tax_token_photo')->store('tax_token_photo', 'public');


        // Store tax token with automatically fetched details
        $taxToken = TaxToken::create([
            'vehicle_id' => $vehicle->id,
            'registration_number' => $validatedData['registration_number'],
            'registration_date' => $validatedData['registration_date'],
            'tax_token_number' => $validatedData['tax_token_number'],
            'tax_token_photo' => $validatedData['tax_token_photo'],
            'print_date' => $validatedData['print_date'],
            'transaction_number' => $validatedData['transaction_number'],
            'eTracking_no' => $validatedData['eTracking_no'],
            'issuing_bank_name' => $validatedData['issuing_bank_name'],
            'issuing_branch' => $validatedData['issuing_branch'],
            'issuing_teller_name' => $validatedData['issuing_teller_name'],
            'chassis_number' => $validatedData['chassis_number'],
            'engine_number' => $validatedData['engine_number'],
            'seats' => $validatedData['seats'],
            'laden_weight' => $validatedData['laden_weight'],
            'owner_name' => $validatedData['owner_name'],
            'father_or_husband_name' => $validatedData['father_or_husband_name'],
            'previous_expiry_date' => $validatedData['previous_expiry_date'],
            'issue_date' => $validatedData['issue_date'],
            'tax_period_start' => $validatedData['tax_period_start'],
            'tax_period_end' => $validatedData['tax_period_end'],
            'principal_amount' => $validatedData['principal_amount'],
            'fine' => $validatedData['fine'] ?? 0,
            'total_amount' => $validatedData['total_amount'],
        ]);

        dd('abc');

        return redirect()->route('show.vehicle.form');
    }
}
