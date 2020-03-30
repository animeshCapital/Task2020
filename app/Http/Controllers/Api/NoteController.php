<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
class NoteController extends Controller
{

    public function create()
    {
        return response()->json(['test' => 'test']);
    }
    public function store(Request $request)
    {
        return response()->json(['store' => 'success']);
    }
}
