<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Note;
use Auth;
class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('user_id', Auth::user()->id)->get();
        return response(['notes' => $notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'status' => 'required'
        ]);
        $note = Note::create([
            'user_id' => Auth::user()->id,
            'text' => $request->text,
            'status' => $request->status,
            
            ]);
        if($note)
        {
            return response(['success' => 'Insert Successfully']);
        }
        else
        {
            return response(['error' => 'Somethings goes wrong']);    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noteDetails = Note::find($id);
        return response(['noteDetails' => $noteDetails]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::find($id);
        $request->validate([
            'text' => 'required',
            'status' => 'required'
        ]);
        $note = $note->update([
            'text' => $request->text,
            'status' => $request->status,
            
            ]);
        if($note)
        {
            return response(['note' => $note, 'success' => 'Update Successfully']);
        }
        else
        {
            return response(['error' => 'Somethings goes wrong']);    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $data = $note->delete();
        if($data)
        {
            return response(['success' => 'Remove Successfully']);
        }
        else
        {
            return response(['error' => 'Somethings goes wrong']);    
        }
    }
}
