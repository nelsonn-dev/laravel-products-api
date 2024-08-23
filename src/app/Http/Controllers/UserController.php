<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('email', $request->email)->first();

            if (! $user || ! Hash::check($request->password, $user->password)) {
                throw new Exception("The provided credentials are incorrect.", 400);
            }

            $token =  $user->createToken($request->email)->plainTextToken;

            return response()->json([
                'message' => "Success.",
                'data' => $token,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => [],
            ], $e->getCode() ?: 400);
        }
    }
}
