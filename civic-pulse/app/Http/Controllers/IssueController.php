<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Optional: Useful for deleting old images

class IssueController extends Controller
{
    // 1. Show the list of issues
    public function index() {
        // JOB READY TIP: Use 'latest()->get()' to show newest issues first
        // 'with('user')' prevents the database from being hit 100 times (N+1 Problem)
        $issues = Issue::with('user')->latest()->get();
        return view('issues.index', ['issues' => $issues]);
    }

    // 2. Show the "Create New Issue" form
    public function create() {
        return view('issues.create');
    }

    // 3. Store the data from the form
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:5|max:50',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle File Upload
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('issues', 'public');
        }

        Issue::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $path,
            // We use auth()->id() because the middleware guarantees the user is logged in
            'user_id' => Auth::id() 
        ]);

        return redirect('/issues')->with('success', 'Issue created successfully!');
    }

    // 4. Show a single issue
    public function show(Issue $issue)
    {
        return view('issues.show', ['issue' => $issue]);
    }

    // 5. Show the Edit Form
    public function edit(Issue $issue)
    {
        // AUTHORIZATION CHECK: Only Owner
        if (Auth::id() !== $issue->user_id) {
            abort(403, 'Unauthorized action. You can only edit your own issues.');
        }

        return view('issues.edit', ['issue' => $issue]);
    }

    // 6. Save the Changes
    public function update(Request $request, Issue $issue)
    {
        // AUTHORIZATION CHECK: Only Owner
        if (Auth::id() !== $issue->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|min:5|max:50',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Handle Image Update
        if ($request->hasFile('image')) {
            // (Optional Pro Move: Delete the old image here if you want to save space)
            $data['image_path'] = $request->file('image')->store('issues', 'public');
        }

        $issue->update($data);
        
        return redirect()->route('issues.show', $issue->id)->with('success', 'Issue updated!');
    }

    // 7. Delete the issue
    public function destroy(Issue $issue)
    {
        // CRITICAL FIX: Added Authorization Check
        // Before this, anyone could delete anyone's post!
        if (Auth::id() !== $issue->user_id) {
            abort(403, 'Unauthorized action. You do not own this issue.');
        }

        // Delete the issue from DB
        $issue->delete();

        return redirect('/issues')->with('success', 'Issue deleted successfully.');
    }

    // 8. Update Status (Admin Only)
    public function updateStatus(Request $request, Issue $issue)
    {
        // SECURITY CHECK: Admin Only
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'You do not have permission to perform this action.');
        }

        $request->validate([
            'status' => 'required|in:Pending,In Progress,Resolved'
        ]);

        $issue->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated successfully!');
    }
}