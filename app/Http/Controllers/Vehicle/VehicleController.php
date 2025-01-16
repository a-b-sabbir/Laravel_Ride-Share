<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Models\Vehicle\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{

    public function store(Request $request)
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

            $vehcilePhotoPath = $request->file('photo')->store('vehicle_photos', 'public');
          
            $vehicle = Vehicle::create([
                'type' => $validatedData['type'],
                'photo' => $vehcilePhotoPath,
                'vehicle_number' => $validatedData['vehicle_number'],
                'brand' => $validatedData['brand'],
                'make' => $validatedData['make'],
                'model' => $validatedData['model'],
            ]);
            DB::commit();

            return view('vehicle.tax-token-photo');
        } catch (\Exception $e) {
        }
    }
}
