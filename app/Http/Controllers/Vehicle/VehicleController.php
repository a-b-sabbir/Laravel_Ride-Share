<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{


    public function uploadVehicle(Request $request)
    {

        $validatedData = $request->validate(
            [
                'type' => 'required|in:Car,Bike',
                'certificate_type' => 'required',
                'photo' => 'required|image|mimes:png,jpg,jpeg|max:4000',
                'vehicle_number' => 'required|string|min:3|max:40',
                'brand' => 'required|string',
                'model' => 'required|string',
                'make' => 'required'
            ]
        );

        try {
            $vehicle = Vehicle::where('vehicle_number', $validatedData['vehicle_number'])->first();

            DB::beginTransaction();

            $vehiclePhotoPath = $request->file('photo')->store('vehicle_photos', 'public');

            $vehicle = Vehicle::firstOrCreate([
                'vehicle_number' => $validatedData['vehicle_number'],
            ], [
                'type' => $validatedData['type'],
                'certificate_type' => $validatedData['certificate_type'],
                'photo' => $vehiclePhotoPath,
                'brand' => $validatedData['brand'],
                'make' => $validatedData['make'],
                'model' => $validatedData['model'],

            ]);
            // If the certificate_type is set, update the registration_step
            $vehicle->registration_step = $vehicle->certificate_type === 'Fitness Certificate'
                ? 'Vehicle Fitness Certificate'
                : 'Vehicle Registration Certificate';

            // Save the vehicle after updating the registration_step
            $vehicle->save();   

            DB::commit();


            // Redirect based on vehicle type
            if ($vehicle->certificate_type === 'Fitness Certificate') {
                return redirect()->route('vehicle.fitnessCertificate', ['vehicleID' => $vehicle->id, 'RegNo' => $vehicle->vehicle_number])
                    ->with('success', 'Vehicle details saved. Please upload the Fitness Certificate.');
            } else {
                return redirect()->route('vehicle.registrationCertificateForm', ['vehicleID' => $vehicle->id, 'RegNo' => $vehicle->vehicle_number])
                    ->with('success', 'Vehicle details saved. Please upload the Certificate of Registration.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
