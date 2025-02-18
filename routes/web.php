<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

// Make the homepage display the notes index.
Route::get('/', [NoteController::class, 'index']);

// Resource route for all CRUD operations on notes.
Route::resource('notes', NoteController::class);
