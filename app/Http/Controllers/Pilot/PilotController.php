<?php

namespace App\Http\Controllers\Pilot;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PilotController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'name' => 'required|string',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required|unique:users|',
            'nid' => ['required', 'string', 'unique:pilots,nid', 'regex:/^\d{10}$|^\d{13}$|^\d{17}$/'],
            'nid_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'address' => 'required|string',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string|max:14',
            'relation_with_emergency_contact' => 'nullable|string',
            'preferred_shift' => 'nullable|in:day,night,flexible',
            'preferred_vehicle_type' => 'required|in:car,bike'
        ]);

        try {
            DB::beginTransaction(); //Start Database Transaction

            // Handle profile photo upload if provided
            $profilePhotoPath = null;
            if (isset($validatedData['profile_photo'])) {
                $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            }

            // Handle NID image upload if provided
            $nidImagePath = null;
            if (isset($validatedData['nid_image'])) {
                $nidImagePath = $request->file('nid_image')->store('nid_images', 'public');
            }


            $user = User::create([
                'profile_photo' => $profilePhotoPath,
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phone_number'],
                'password' => bcrypt($validatedData['password']),
                'role_id' => 4
            ]);


            $pilot = Pilot::create([
                'user_id' => $user->id,
                'nid' => $validatedData['nid'],
                'nid_image' => $nidImagePath,
                'address' => $validatedData['address'],
                'emergency_contact_name' => $validatedData['emergency_contact_name'],
                'emergency_contact_number' => $validatedData['emergency_contact_number'],
                'relation_with_emergency_contact' => $validatedData['relation_with_emergency_contact'],
                'preferred_shift' => $validatedData['preferred_shift'],
                'preferred_vehicle_type' => $validatedData['preferred_vehicle_type'],
            ]);

            DB::commit();

            // Redirect to the success page with a success message
            return redirect()->route('pilot_license')->with('success', 'Pilot basic registration successful. Please fill up the current form.');
        } catch (\Exception $e) {
            DB::rollBack();
            // Redirect to the fail page with an error message
            return redirect()->route('pilot.fail')->with('error', 'Pilot registration failed. Please try again.');
        }
    }
}
