<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credendials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(Auth::attempt($credendials))
        {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return response(['user' => Auth::user(), 'access_token' => $accessToken]);
        }
        else
        {
            return response(['message' => 'Invalid Credendials']);    
        }
    }
    public function logout()
    {
        Auth::logout();
        return response(['message' => 'Logout successfully']);
    }
}
