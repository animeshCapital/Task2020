<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\user;
use Auth;
use Validator;
class UserController extends Controller
{
    public function details()
    {
    	return response()->json(['user' => 'hi']);
    }
}
