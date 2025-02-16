<?php

namespace App\Http\Controllers\Pilot;

use App\Http\Controllers\Controller;
use App\Models\Pilot;
use App\Models\PilotVehicleAssignment;
use App\Models\Referral;
use App\Models\User;
use App\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,png,jpeg|max:5000',
            'name' => 'required|string',
            'email' => 'required|email|max:100',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'phone_number' => 'required',
            'nid' => ['required', 'string', 'regex:/^\d{10}$|^\d{13}$|^\d{17}$/'],
            'nid_image' => 'required|image|mimes:jpg,png,jpeg|max:5000',
            'address' => 'required|string',
            'emergency_contact_name' => 'nullable|string',
            'emergency_contact_number' => 'nullable|string|max:14',
            'relation_with_emergency_contact' => 'nullable|string',
            'preferred_shift' => 'nullable|in:day,night,flexible',
            'referral_code' => 'nullable|exists:users,referral_code'

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
                ['phone_number' => $validatedData['phone_number']],
                [
                    'profile_photo' => $profilePhotoPath,
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt($validatedData['password']),
                    'role_id' => 4
                ]
            );



            if ($request->referral_code) {
                $referrer = User::where('referral_code', $validatedData['referral_code'])->first();

                if ($referrer) {
                    $existingReferral = Referral::where('referred_user_id', $user->id)->first();

                    if ($existingReferral) {
                        // Update the existing referral if necessary
                        $existingReferral->update([
                            'referrer_user_id' => $referrer->id,  // Optional: Update referrer if needed
                            'status' => 'Pending',
                            'rewards_given' => false,
                        ]);
                    } else {
                        // Create a new referral entry if not exists
                        Referral::create([
                            'referrer_user_id' => $referrer->id,
                            'referred_user_id' => $user->id,
                            'referred_user_type' => null,
                            'status' => 'Pending',
                            'rewards_given' => false
                        ]);
                    }
                }
            }

            // Check if the pilot already exists
            $pilot = Pilot::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'nid' => $validatedData['nid']
                ],
                [
                    'nid_image' => $nidImagePath,
                    'address' => $validatedData['address'],
                    'emergency_contact_name' => $validatedData['emergency_contact_name'],
                    'emergency_contact_number' => $validatedData['emergency_contact_number'],
                    'relation_with_emergency_contact' => $validatedData['relation_with_emergency_contact'],
                    'preferred_shift' => $validatedData['preferred_shift'],
                    'registration_step' => 'Driving License'
                ]
            );
            DB::commit();

            if ($pilot->registration_step === 'Driving License') {
                return redirect()->route('show.pilot.license.form', ['pilot' => $pilot->id])->with('success', 'Pilot basic registration successful. Please proceed to the license step.');
            } elseif ($pilot->registration_step === 'Basic Vehicle Info') {
                return redirect()->route('show.vehicle.form', ['pilot' => $pilot->id])->with('success', 'Pilot License registration successful. Please submit the vehicle basic form.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Pilot registration failed. Please try again.');
        }
    }

    public function licenseStep($id) {}
    public function vehicleStep($id) {}
}
