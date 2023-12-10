<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::all();
        return View::make('admin.complaint.index', ['complaints' => $complaints]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            // Your validation rules here
        ]);

        // Create a new complaint
        Complaint::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // Add other fields as needed
        ]);

        // Redirect to the index or show page
        return redirect()->route('admin.index')->with('success', 'Complaint created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the complaint by ID
        $complaint = Complaint::findOrFail($id);

        // Return the complaint details view
        return view('admin.complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the complaint by ID
        $complaint = Complaint::findOrFail($id);

        // Return the edit complaint form view
        return view('admin.complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            // Your validation rules here
        ]);

        // Find the complaint by ID
        $complaint = Complaint::findOrFail($id);

        // Update the complaint with the new data
        $complaint->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // Update other fields as needed
        ]);

        // Redirect to the index or show page
        return redirect()->route('admin.index')->with('success', 'Complaint updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the complaint by ID and delete it
        Complaint::findOrFail($id)->delete();

        // Redirect to the index page
        return redirect()->route('admin.index')->with('success', 'Complaint deleted successfully');
    }
}
