<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    // Show the form
    Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');

    // Handle form submission
    Route::post('/issues', [IssueController::class, 'store']);

    // Show the edit form
    Route::get('/issues/{issue}/edit', [IssueController::class, 'edit'])->name('issues.edit');

    // Save the changes (PUT)
    Route::put('/issues/{issue}', [IssueController::class, 'update'])->name('issues.update');

    // Handle the delete request (DELETE)
    Route::delete('/issues/{issue}', [IssueController::class, 'destroy'])->name('issues.destroy');

    Route::post('/issues/{issue}/status', [IssueController::class, 'updateStatus'])->name('issues.updateStatus');
});


// These routes should still be public
Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/{issue}', [IssueController::class, 'show'])->name('issues.show');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Logout Route (Must be POST for security)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');