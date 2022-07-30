<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        try {
            $attr = $request->validate([
                'email' => 'required|string|email|',
                'password' => 'required|string|min:6'
            ]);
    
            if (!Auth::attempt($attr)) {
                return response('Credentials not match', 400);
            }
            $user = User::where('email', $request->email)->first();
            
            return response([
                'user' => $user,
                'token' => auth()->user()->createToken('API Token')->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
