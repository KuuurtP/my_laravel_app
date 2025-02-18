<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Retrieve all notes from the database, ordered by creation date (descending),
        // and paginate them (5 per page).
        $notes = Note::latest()->paginate(5);

        // Return the "notes.index" view, passing the $notes collection
        // plus a variable 'i' that helps in numbering the items if needed.
        return view('notes.index', compact('notes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Return the "notes.create" view which has the form to create a new note.
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NoteStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NoteStoreRequest $request): RedirectResponse
    {
        // The NoteStoreRequest handles validation. If validation fails,
        // it redirects back with errors automatically.
        // If it passes, we create a new Note using the validated data.
        Note::create($request->validated());

        // Redirect back to the "notes.index" route, with a success message in session.
        return redirect()->route('notes.index')
                         ->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\View\View
     */
    public function show(Note $note): View
    {
        // Return the "notes.show" view, passing the $note instance.
        // Typically used to display a single note in detail.
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\View\View
     */
    public function edit(Note $note): View
    {
        // Return the "notes.edit" view, passing the $note instance.
        // This view contains the form to edit an existing note.
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NoteUpdateRequest  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NoteUpdateRequest $request, Note $note): RedirectResponse
    {
        // The NoteUpdateRequest also handles validation for updating notes.
        // We update the existing $note with the validated data.
        $note->update($request->validated());

        // Redirect to "notes.index" with a success message.
        return redirect()->route('notes.index')
                         ->with('success', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Note $note): RedirectResponse
    {
        // Delete the specified note from the database.
        $note->delete();

        // Redirect back to the index with a success message.
        return redirect()->route('notes.index')
                         ->with('success', 'Note deleted successfully');
    }
}
