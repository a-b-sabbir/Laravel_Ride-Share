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
                'photo' => 'required|image|mimes:png,jpg,jpeg|max:4000',
                'vehicle_number' => 'required|string|min:3|max:20',
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
                'photo' => $vehiclePhotoPath,
                'vehicle_number' => $validatedData['vehicle_number'],
                'brand' => $validatedData['brand'],
                'make' => $validatedData['make'],
                'model' => $validatedData['model'],
                'registration_step' => $validatedData['type'] === 'Car'
                    ? 'Vehicle Fitness Certificate'
                    : 'Vehicle Registration Certificate'
            ]);


            DB::commit();

            // Redirect based on vehicle type
            if ($validatedData['type'] === 'Car') {
                return redirect()->route('vehicle.fitnessCertificate', ['vehicleID' => $vehicle->id])
                    ->with('success', 'Vehicle details saved. Please upload the Fitness Certificate.');
            } else {
                return view('vehicle.registration_certificate_form', [
                    'vehicleID' => $vehicle->id,
                    'successMessage' => 'Vehicle details saved. Please upload the Certificate of Registration.'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
