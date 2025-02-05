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
                'vehicle_number' => 'required|string|min:3|max:40|unique:vehicles,vehicle_number',
                'brand' => 'required|string',
                'model' => 'required|string',
                'make' => 'required'
            ]
        );

        try {
            DB::beginTransaction();

            $vehiclePhotoPath = $request->file('photo')->store('vehicle_photos', 'public');

            $vehicle = Vehicle::create([
                'type' => $validatedData['type'],
                'certificate_type' => $validatedData['certificate_type'],
                'photo' => $vehiclePhotoPath,
                'vehicle_number' => $validatedData['vehicle_number'],
                'brand' => $validatedData['brand'],
                'make' => $validatedData['make'],
                'model' => $validatedData['model'],
                'registration_step' => $validatedData['certificate_type'] === 'Fitness Certificate'
                    ? 'Vehicle Fitness Certificate'
                    : 'Vehicle Registration Certificate'
            ]);


            DB::commit();


            // Redirect based on vehicle type
            if ($validatedData['certificate_type'] === 'Fitness Certificate') {
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
