<?php

namespace App\Http\Controllers\Pilot;

use App\Http\Controllers\Controller;
use App\Models\Pilot\Pilot;
use App\Models\Pilot\PilotLicense;
use App\Models\Pilot_License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use thiagoalessio\TesseractOCR\TesseractOCR;

class LicenseController extends Controller
{

    public function showLicenseForm($pilotId)
    {
        $pilot = Pilot::find($pilotId);

        if (!$pilot) {
            return redirect()->route('pilot.fail')->with('error', 'Pilot not found. Please ensure the correct ID.');
        }

        // Pass the pilot_id to the view
        return view('roles.pilot.license_form', ['pilot' => $pilot]);
    }


    public function uploadLicense(Request $request)
    {

        $validatedData = $request->validate([
            'pilot_id' => 'required|exists:pilots,id|unique:pilot_licenses,pilot_id',
            'license_photo' => 'required|image|mimes:jpg,png,jpeg|max:5000',
            'type' => 'required|in:Professional,Non-Professional',
            'name' => 'required|string|min:3|max:100',
            'address' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'blood_group' => 'required|string',
            'father_or_husband_name' => 'required|string|min:3|max:100',
            'license_number' => 'required|unique:pilot_licenses,license_number|min:5|max:20',
            'issue_date' => 'required|date|before_or_equal:today',
            'expiry_date' => 'required|date|after:today',
            'ref_no' => 'nullable|int',
            'issuing_authority' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $licensePhotoPath = $request->file('license_photo')->store('license_photos', 'public');

            $pilot = Pilot::find($validatedData['pilot_id']);

            if (!$pilot) {
                return redirect()->back()->with('error', 'Pilot not found.');
            }

            PilotLicense::create([
                'pilot_id' => $pilot->id,
                'license_photo' => $licensePhotoPath,
                'type' => $validatedData['type'],
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'birth_date' => $validatedData['birth_date'],
                'blood_group' => $validatedData['blood_group'],
                'father_or_husband_name' => $validatedData['father_or_husband_name'],
                'license_number' => $validatedData['license_number'],
                'issue_date' => $validatedData['issue_date'],
                'expiry_date' => $validatedData['expiry_date'],
                'ref_no' => $validatedData['ref_no'],
                'issuing_authority' => $validatedData['issuing_authority']
            ]);


            // Update the registration_step in Pilot model
            $pilot->registration_step = 'Basic Vehicle Info'; // Update to the next step
            $pilot->save(); // Save the updated pilot record

            DB::commit();

            return view('vehicle.vehicle_form')->with('success', 'Pilot license update successful. Please fill up the current form.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('pilot.fail')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
