<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Note::where('user_id', Auth::user()->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $note = $request->user()->notes()->create($validated);

        return [
            'message' => 'Note successfully created.',
            'data' => $note
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        Gate::authorize('view', $note);
        return $note;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        Gate::authorize('update', $note);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $note->update($validated);

        return [
            'message' => 'Note successfully updated',
            'note' => $note
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);
        $note->delete();

        return ['message' => 'Note successfully deleted.'];
    }
}
