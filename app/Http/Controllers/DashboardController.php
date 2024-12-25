<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (Auth::user()->role_id == '1') {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('super_admin/dashboard', $data);
        } elseif (Auth::user()->role_id == '2') {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('admin/dashboard', $data);
        } elseif (Auth::user()->role_id == '3') {
            $data['getRecord'] = User::find(Auth::user()->id);
            return view('sub_admin/dashboard', $data);
        } else {
        }
    }
}
