<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::get('/', function () {
    return view('welcome');
});


// Show the list
Route::get('/issues', [IssueController::class, 'index']);

// Show the form
Route::get('/issues/create', [IssueController::class, 'create']);

// Handle the form submission (Note: This is a POST request)
Route::post('/issues', [IssueController::class, 'store']);

// The '{issue}' acts as a wildcard. 
// If user visits /issues/1, Laravel knows $issue = Issue with ID 1.
Route::get('/issues/{issue}', [IssueController::class, 'show'])->name('issues.show');

// Show the edit form
Route::get('/issues/{issue}/edit', [IssueController::class, 'edit'])->name('issues.edit');

// Save the changes (Note: We use PUT for updates)
Route::put('/issues/{issue}', [IssueController::class, 'update'])->name('issues.update');

Route::delete('/issues/{issue}', [IssueController::class, 'destroy'])->name('issues.destroy');