<?php

namespace App\Http\Controllers;

use App\Models\Note;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();

        return response()->json($notes, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->all());

        return response()->json($note, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return response()->json($note, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $note->update($request->all());

        return response()->json($note, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
