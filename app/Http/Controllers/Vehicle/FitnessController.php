<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\Car\Fitness;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;

class FitnessController extends Controller
{
    public function showFitnessForm($vehicleID, $RegNo)
    {
        return view('vehicle.fitness', [
            'vehicleID' => $vehicleID,
            'registration_number' => $RegNo
        ]);
    }

    public function uploadFitness(Request $request)
    {
        $validatedData = $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id|unique:vehicle_fitness,vehicle_id',
            'fitness_photo' => 'required|image|mimes:jpeg,jpg,png|max:5000',
            'vehicle_identity_no' => 'required',
            'user_identity_no' => 'required',
            'registration_no' => 'required|unique:vehicle_fitness,registration_no',
            'certificate_no' => 'required|unique:vehicle_fitness,certificate_no',
            'vehicle_description' => 'required',
            'chassis_no' => 'required|unique:vehicle_fitness,chassis_no',
            'engine_no' => 'required|unique:vehicle_fitness,engine_no',
            'hired' => 'required|boolean',
            'seats' => 'required|integer|min:1',
            'cylinder' => 'required|integer|min:1',
            'cc' => 'required|integer|min:1',
            'unladen_weight' => 'required|integer|min:1',
            'laden_weight' => 'required|integer|min:1',
            'color' => 'required|string',
            'number_of_tyres' => 'required|integer|min:1',
            'size_of_tyre' => 'required|string',
            'dimension_length' => 'required|integer|min:1',
            'dimension_width' => 'required|integer|min:1',
            'dimension_height' => 'required|integer|min:1',
            'front_overhang' => 'required|string',
            'back_overhang' => 'required|string',
            'name' => 'required|string',
            'husband_or_father_name' => 'required|string',
            'address' => 'required|string',
            'TIN' => 'required|unique:vehicle_fitness,TIN',
            'issue_date' => 'required|date',
            'fitness_period_start' => 'required|date',
            'fitness_period_end' => 'required|date|after_or_equal:fitness_period_start',
            'inspector_name' => 'required|string',
            'inspector_designation' => 'required|string',
            'inspector_area' => 'required|string',
            'inspection_date' => 'required|date',
        ]);

        $vehicle = Vehicle::findOrFail($validatedData['vehicle_id']);

        $fitnessPhotoPath = $request->file('fitness_photo')->store('fitness_photo', 'public');

        Fitness::create([
            'vehicle_id' => $vehicle->id,
            'fitness_photo' => $fitnessPhotoPath,
            'vehicle_identity_no' => $validatedData['vehicle_identity_no'],
            'user_identity_no' => $validatedData['user_identity_no'],
            'registration_no' => $validatedData['registration_no'],
            'certificate_no' => $validatedData['certificate_no'],
            'vehicle_description' => $validatedData['vehicle_description'],
            'chassis_no' => $validatedData['chassis_no'],
            'engine_no' => $validatedData['engine_no'],
            'hired' => $validatedData['hired'],
            'seats' => $validatedData['seats'],
            'cylinder' => $validatedData['cylinder'],
            'cc' => $validatedData['cc'],
            'unladen_weight' => $validatedData['unladen_weight'],
            'laden_weight' => $validatedData['laden_weight'],
            'color' => $validatedData['color'],
            'number_of_tyres' => $validatedData['number_of_tyres'],
            'size_of_tyre' => $validatedData['size_of_tyre'],
            'dimension_length' => $validatedData['dimension_length'],
            'dimension_width' => $validatedData['dimension_width'],
            'dimension_height' => $validatedData['dimension_height'],
            'front_overhang' => $validatedData['front_overhang'],
            'back_overhang' => $validatedData['back_overhang'],
            'name' => $validatedData['name'],
            'husband_or_father_name' => $validatedData['husband_or_father_name'],
            'address' => $validatedData['address'],
            'TIN' => $validatedData['TIN'],
            'issue_date' => $validatedData['issue_date'],
            'fitness_period_start' => $validatedData['fitness_period_start'],
            'fitness_period_end' => $validatedData['fitness_period_end'],
            'inspector_name' => $validatedData['inspector_name'],
            'inspector_designation' => $validatedData['inspector_designation'],
            'inspector_area' => $validatedData['inspector_area'],
            'inspection_date' => $validatedData['inspection_date']
        ]);

        return redirect()->route('vehicle.taxTokenForm', ['vehicleID' => $vehicle->id]);
    }
}
