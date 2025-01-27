<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();

        $data['profile_photo'] = $user->profile_photo;
        $data['user_name'] = $user->name;
        $data['email'] = $user->email;


        return view('roles.sub_admin.profile.profile', $data);
    }
}
