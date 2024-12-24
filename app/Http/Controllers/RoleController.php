<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function store(Request $request)
    {

        $role = Role::create(
            [
                'name' => $request->name
            ]
        );

        return response()->json([
            'status' => true,
            'message' => "Data added succesfully",
            'data' => $role
        ]);
    }
}
