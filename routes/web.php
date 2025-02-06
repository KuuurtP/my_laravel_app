<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController; // Import the controller

Route::get('/', function () {
    return view('welcome');
});

Route::resource('notes', NoteController::class); // Add the resource route