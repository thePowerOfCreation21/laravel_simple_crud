<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login (Request $request)
    {
        $loginData = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'password' => ['required', 'string', 'max:100']
        ]);

        $admin = AdminModel::where('name', $loginData['name'])->first();

        if (! empty($admin) && Hash::check($loginData['password'], $admin->password))
        {
            return response()->json([
                'token' => $admin->createToken('auth_token')->plainTextToken
            ]);
        }

        return response()->json([
            'code' => '6',
            'message' => 'login info was wrong'
        ], 401);
    }
}
