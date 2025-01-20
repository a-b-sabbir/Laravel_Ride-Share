<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Passenger\Passenger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webpatser\Countries\Countries;

class PassengerController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:5000',
            'name' => 'required|string',
            'country' => 'required|string',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required|unique:users|',
            'address' => 'required|string',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string|max:14',
            'relation_with_emergency_contact' => 'nullable|string',
        ]);


        try {
            DB::beginTransaction(); //Start Database Transaction

            // Handle profile photo upload if provided
            $profilePhotoPath = null;
            if (isset($validatedData['profile_photo'])) {
                $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            }

            $user = User::create([
                'profile_photo' => $profilePhotoPath,
                'name' => $validatedData['name'],
                'phone_number' => $validatedData['phone_number'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'role_id' => 5
            ]);

            Passenger::create([
                'user_id' => $user->id,
                'country' => $validatedData['country'],
                'address' => $validatedData['address'],
                'emergency_contact_name' => $validatedData['emergency_contact_name'],
                'emergency_contact_number' => $validatedData['emergency_contact_number'],
                'relation_with_emergency_contact' => $validatedData['relation_with_emergency_contact'],
            ]);

            DB::commit();


            // Redirect to the success page with a success message
            return view('auth.login');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->json([
                'error' => $request->errors()->all()
            ]);
        }
    }
}
