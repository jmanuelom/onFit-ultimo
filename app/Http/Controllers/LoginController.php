<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                return response()->json([
                    'success' => true,
                    'message' => 'User validated succesfully',
                    'data' => $user
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error validating user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
