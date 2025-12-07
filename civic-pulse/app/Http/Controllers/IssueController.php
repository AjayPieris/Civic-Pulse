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

    // 2. Show the "Create  New Issue" form
    public function create() {
        return view('issues.create');
    }

    // 3. Store the data from the form
   public function store(Request $request) {
        $request->validate([
            // Must be required, and at least 5 characters long, max 50 characters
            'title' => 'required|min:5|max:50',
            
            // Must be required, at least 10 characters
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Max 2MB
        ]);

        // Handle File Upload
    $path = null;
    if ($request->hasFile('image')) {
        // This stores the image in 'storage/app/public/issues'
        // It returns the path (e.g., "issues/xgY7s...jpg")
        $path = $request->file('image')->store('issues', 'public');
    }

        Issue::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path, // Save the path (or null)
        ]);

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

   // 5. Show the Edit Form (filled with existing data)
   // 5. Show the Edit Form (filled with existing data)
    public function edit(Issue $issue)
    {
        return view('issues.edit', ['issue' => $issue]);
    }

    // 6. Save the Changes
    public function update(Request $request, Issue $issue)
    {
        // 1. Validate (Security)
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        // 2. Update the data
        $issue->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'Pending' // Optional: reset status or keep it? Let's reset for now.
        ]);

        // 3. Redirect back to the details page
        return redirect()->route('issues.show', $issue->id);
    }

    public function destroy(Issue $issue)
    {
        // Delete the issue
        $issue->delete();

        // Redirect back to the list
        return redirect('/issues');
    }
}