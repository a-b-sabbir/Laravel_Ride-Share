<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register_post(Request $request)
    {
        // dd($request->all());
        // Validate the input data to ensure the required fields are present and correct
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "phone_number" => "required",
            "role_id" => "required|exists:roles,id",
            "password" => "required",
            "confirm_password" => "required|same:password",
            "profile_photo" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => "Validation Error",
                "errors" => $validator->errors()->all()
            ]);
        }

        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public'); // Store in 'storage/app/public/profile_photos'
        }

        $user = User::create(
            [
                "name" => $request->name,
                "email" => $request->email,
                "phone_number" => $request->phone_number,
                "password" => bcrypt($request->password),
                "role_id" => $request->role_id,
                "profile_photo" => $profilePhotoPath, // Save file path to the database
            ]
        );

        $response = [];
        $response['token'] = $user->createToken("MyApp")->accessToken;
        $response['user'] = $user->name;
        $response['email'] = $user->email;
        $response['phone_number'] = $user->phone_number;
        $response['role_id'] = $user->role_id;


        return response()->json([
            "status" => true,
            "message" => "User registered",
            "data" => $response
        ]);
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        if (Auth::attempt([
            "email" => $request->email,
            "password" => $request->password
        ], $request->has('remember'))) {

            // If authentication is successful, get the authenticated user
            $user = Auth::user();

            session(['user_name' => $user->name]); // Store user name in session

            // Redirect based on role for web-based login
            switch ($user->role_id) {
                case 1: // Super Admin
                    return redirect()->intended('roles/super_admin/dashboard');
                case 2: // Admin
                    return redirect()->intended('roles/admin/dashboard');
                case 3: // Sub Admin
                    return redirect()->intended('roles/sub_admin/dashboard');
                case 4: // Pilot
                    return redirect()->intended('roles/pilot/dashboard');
                case 5: // Passenger
                    return redirect()->intended('roles/passenger/dashboard');
                default:
                    Auth::logout();
                    return redirect()->back()->with('error', 'Invalid role.');
            }

            // Prepare a response with the user's token and details
            $response = [];
            $response['token'] = $user->createToken("MyApp")->accessToken;
            $response['user'] = $user->name;
            $response['email'] = $user->email;

            return response()->json([
                "status" => true,
                "message" => "User logged in",
                "data" => $response
            ]);
        }
        return response()->json([
            "status" => false,
            "message" => "User not registered",
            "data" => null
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated',
            ], 401);
        }

        // Revoke all tokens for the authenticated user
        $user->tokens->each(function ($token) {
            $token->delete();
        });
        Auth::logout();
        return redirect(url('login'));
    }
    public function forgot(Request $request) {}
}
