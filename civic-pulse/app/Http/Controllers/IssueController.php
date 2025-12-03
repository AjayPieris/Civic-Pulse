<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class IssueController extends Controller
{
    // 1. Show the list of issues
    public function index() {
        $issues = Issue::all();
        return view('issues.index', ['issues' => $issues]);
    }

    // 2. Show the "Create New Issue" form
    public function create() {
        return view('issues.create');
    }

    // 3. Store the data from the form
    public function store(Request $request) {
        // Validate the data (Security Check)
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // Create the issue (The Shortcut method you just learned!)
        Issue::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Go back to the list
        return redirect('/issues');
    }

   // 4. Show a single issue
    // NOTICE: We type-hint 'Issue $issue'. 
    // Laravel sees the ID in the URL, finds the matching row in the DB, 
    // and gives it to us as the $issue variable. Automatic!
    public function show(Issue $issue)
    {
        return view('issues.show', ['issue' => $issue]);
    }
}