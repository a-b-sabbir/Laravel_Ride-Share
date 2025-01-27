<?php

namespace App\Http\Controllers\Pilot;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use App\Models\User;
use App\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PilotController extends Controller
{

    protected $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService; // Inject the service
    }

    public function sendOtp(Request $request)
    {

        $validated = $request->validate([
            'phone_number' => 'required|regex:/^\+?\d{10,15}$/',
        ]);
        $phoneNumber = $validated['phone_number']; // Get the phone number
        $otp = rand(100000, 999999); // Generate OTP
        $message = "Your OTP is: $otp"; // OTP message

        // Generate unique client transaction ID (can use timestamp or random string)
        $clientTransId = uniqid('OTP-', true);
        $billMsisdn = '01313704545'; // This is the billing MSISDN

        // Call the sendOTP method from the service
        $response = $this->smsService->sendOTP([$phoneNumber], $message, $clientTransId, $billMsisdn);
        dd($response);
        // Handle the response
        if ($response['statusInfo']['statusCode'] == 1000) {
            return response()->json(['message' => 'OTP sent successfully.']);
        } else {
            return response()->json(['error' => 'Failed to send OTP.'], 500);
        }
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'profile_photo' => 'nullable|image|mimes:jpg,png,jpeg|max:5000',
            'name' => 'required|string',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required|unique:users|',
            'nid' => ['required', 'string', 'unique:pilots,nid', 'regex:/^\d{10}$|^\d{13}$|^\d{17}$/'],
            'nid_image' => 'required|image|mimes:jpg,png,jpeg|max:5000',
            'address' => 'required|string',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string|max:14',
            'relation_with_emergency_contact' => 'nullable|string',
            'preferred_shift' => 'nullable|in:day,night,flexible',
        ]);

        try {
            DB::beginTransaction(); //Start Database Transaction

            // Handle profile photo upload if provided
            $profilePhotoPath = $request->hasFile('profile_photo')
                ? $request->file('profile_photo')->store('profile_photos', 'public')
                : null;

            // Handle NID photo upload if provided
            $nidImagePath = $request->hasFile('nid_image')
                ? $request->file('nid_image')->store('nid_images', 'public')
                : null;


            // Check if the user exists
            $user = User::firstOrCreate(
                [$validatedData['phone_number']],
                [
                    'profile_photo' => $profilePhotoPath,
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'role_id' => 4
                ]
            );
            dd($validatedData);

            // Check if the pilot already exists
            $pilot = Pilot::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nid' => $validatedData['nid'],
                    'nid_image' => $nidImagePath,
                    'address' => $validatedData['address'],
                    'emergency_contact_name' => $validatedData['emergency_contact_name'],
                    'emergency_contact_number' => $validatedData['emergency_contact_number'],
                    'relation_with_emergency_contact' => $validatedData['relation_with_emergency_contact'],
                    'preferred_shift' => $validatedData['preferred_shift'],
                    'registration_step' => 'Driving License'
                ]
            );


            if ($pilot->registration_step === 'Driving License') {
                DB::commit();
                return redirect()->route('pilot_license', ['pilot_id' => $pilot->id])->with('success', 'Pilot basic registration successful. Please proceed to the license step.');
            } elseif ($pilot->registration_step === 'Vehicle Basic') {
                DB::commit();
                return redirect()->route('vehicle.register')->with('success', 'Pilot License registration successful. Please submit the vehicle basic form.');
            }

            DB::commit();
            return redirect()->route('pilot_license', ['pilot_id' => $pilot->id])->with('success', 'Pilot basic registration successful. Please proceed to the license step.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('pilot.fail')->with('error', 'Pilot registration failed. Please try again.');
        }
    }
}
