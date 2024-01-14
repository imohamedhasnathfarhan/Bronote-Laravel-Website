<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
    
        try {
            // Store the note in the database
            Note::create([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
            ]);
    
            return 'Data stored successfully!';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}    
