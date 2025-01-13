<?php

namespace App\Http\Controllers\Pilot;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use App\Models\Pilot\PilotLicense;
use App\Models\Pilot_License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use thiagoalessio\TesseractOCR\TesseractOCR;

class LicenseController extends Controller
{

    public function showLicenseForm(Request $request)
    {
        // Get the pilot_id from the query parameter in the URL
        $pilotId = $request->query('pilot_id');

        // Optionally, validate that pilot_id exists
        if (!$pilotId) {
            return redirect()->route('pilot.fail')->with('error', 'Pilot ID is missing.');
        }

        // Retrieve the pilot's details using the pilot_id
        $pilot = Pilot::findOrFail($pilotId);

        // Pass the pilot_id to the view
        return view('pilot.pilot_license', ['pilotId' => $pilotId]);
    }


    public function uploadLicense(Request $request)
    {
        $validatedData = $request->validate([
            'pilot_id' => 'required|exists:pilots,id|unique:pilot_licenses,pilot_id', // Ensure pilot_id exists in pilots table
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
            'ref_no' => 'nullable|max:20',
            'issuing_authority' => 'required',
        ]);
        
        try {
            DB::beginTransaction();

            $licensePhotoPath = $request->file('license_photo')->store('license_photos', 'public');


            $pilot = Pilot::where('id', $validatedData['pilot_id'])->firstOrfail();

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

            DB::commit();

            return redirect()->route('vehicle.register')->with('success', 'Pilot license update successful. Please fill up the current form.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('pilot.fail')
                ->with('error', 'Error: ' . $e->getMessage());
        }

        //     // Handle the uploaded license image
        //     $license_image_path = $request->file('license_photo')->store('license_photos', 'public');

        //     // Debugging: Log the stored path
        //     if (!file_exists(storage_path('app/public/' . $license_image_path))) {
        //         dd('Image not saved: ' . storage_path('app/public/' . $license_image_path));
        //     }

        //     // Use Tesseract OCR to extract details from the image
        //     $licenseDetails = $this->extractLicenseDetails($license_image_path);

        //     // Pass the extracted details to the view
        //     return view('pilot.license_form', [
        //         'licenseDetails' => $licenseDetails
        //     ]);
        // }

        // private function extractLicenseDetails($imagePath)
        // {
        //     // Using Tesseract OCR to extract text from the image
        //     $licenseText = (new TesseractOCR(storage_path('app/public/' . $imagePath)))->run();
        //     dd($licenseText);
        //     // Extract specific details from the OCR result (you may need to adjust the logic)
        //     $licenseDetails = [
        //         'license_number' => $this->extractData($licenseText, 'License No.'),
        //         'name' => $this->extractData($licenseText, 'Name'),
        //         'blood_group' => $this->extractData($licenseText, 'Blood Group'),
        //     ];

        //     return $licenseDetails;
        // }

        // private function extractData($text, $label)
        // {
        //     // Make matching case-insensitive and more flexible
        //     preg_match("/$label\s*:\s*(.+)/i", $text, $matches);
        //     return trim($matches[1] ?? '');
        // }
    }
}
