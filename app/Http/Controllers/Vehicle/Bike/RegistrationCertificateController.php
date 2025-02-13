<?php

namespace App\Http\Controllers\Vehicle\Bike;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\Bike\RegistrationCertificate;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationCertificateController extends Controller
{

    public function showRegistrationCertificateForm($vehicleID, $RegNo)
    {
        return view('vehicle.registration_certificate_form', [
            'vehicleID' => $vehicleID,
            'registration_number' => $RegNo
        ]);
    }

    public function uploadRegistrationCertificate(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required|unique:vehicle_registration_certificate,vehicle_id',
            'registration_photo' => 'required|image|mimes:jpg,png,jpeg|max:5000',
            'registration_number' => 'required|string|max:30|unique:vehicle_registration_certificate,registration_number',
            'date' => 'required|date|before_or_equal:today',
            'vehicle_description' => 'required|string|max:50',
            'vehicle_class' => 'required|string|max:50',
            'color' => 'required|string|max:20',
            'cc' => 'required|integer|max:1000', // Ensures realistic engine capacity
            'fuel' => 'required|string',
            'seat' => 'required|integer|min:1|max:20', // Ensures realistic seat count
            'engine_no' => 'required|string|max:50|unique:vehicle_registration_certificate,engine_no',
            'chassis_no' => 'required|string|max:50|unique:vehicle_registration_certificate,chassis_no',
            'hire' => 'required|boolean',
            'wheelbase' => 'required',
            'unladen_weight' => 'required', // Weight in KG
            'laden_weight' => 'required|gte:unladen_weight', // Must be greater than or equal to unladen weight
            'issuing_authority' => 'required|string|max:50'
        ]);

        try {

            DB::beginTransaction();

            $vehicle = Vehicle::find($validatedData['vehicle_id']);

            if (!$vehicle) {
                return redirect()->back()->with('error', 'Vehicle ID not found');
            }

            // Store the uploaded photo
            $registrationPhotoPath = $request->file('registration_photo')->store('registration_photo', 'public');


            $registrationCertificate = RegistrationCertificate::create([
                'vehicle_id' => $vehicle->id,
                'registration_photo' => $registrationPhotoPath,
                'registration_number' => $validatedData['registration_number'],
                'date' => $validatedData['date'],
                'vehicle_description' => $validatedData['vehicle_description'],
                'vehicle_class' => $validatedData['vehicle_class'],
                'color' => $validatedData['color'],
                'cc' => $validatedData['cc'],
                'fuel' => $validatedData['fuel'],
                'seat' => $validatedData['seat'],
                'engine_no' => $validatedData['engine_no'],
                'chassis_no' => $validatedData['chassis_no'],
                'hire' => $validatedData['hire'],
                'wheelbase' => $validatedData['wheelbase'],
                'unladen_weight' => $validatedData['unladen_weight'],
                'laden_weight' => $validatedData['laden_weight'],
                'issuing_authority' => $validatedData['issuing_authority']
            ]);
            dd($validatedData);

            // Update the registration_step in Vehicle model
            $vehicle->registration_step = 'Vehicle Tax Token'; // Update to the next step
            $vehicle->save(); // Save the updated pilot record

            // Commit the transaction
            DB::commit();

            if ($vehicle->registration_step === 'Vehicle Tax Token') {
                return view('vehicle.tax-token-form', ['vehicleId' => $vehicle->id])->with('success', 'Vehicle registration certificate info update successful. Please proceed to the Tax Token step.');
            } elseif ($vehicle->registration_step === 'Basic Vehicle Info') {
                return redirect()->route('show.vehicle.form', ['vehicleId' => $vehicle->id])->with('success', 'Pilot License registration successful. Please submit the vehicle basic form.');
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->withErrors(['error' => 'Something went wrong!']);
        }
    }
}
