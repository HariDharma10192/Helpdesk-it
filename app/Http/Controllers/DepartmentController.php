<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $complaints = Complaint::all();
    //     return View::make('dept.complaint.index', ['complaints' => $complaints]);
    // }


    public function index()
    {
        // Dapatkan pengguna yang sedang login
        $user = Auth::user();

        // Dapatkan complaints yang memiliki department_destination sama dengan name pengguna
        $complaints = Complaint::where('department_destination', $user->name)->get();

        return view('dept.complaint.index', ['complaints' => $complaints]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);

        return view('dept.complaint.show', ['complaint' => $complaint]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);

        return view('dept.complaint.edit', ['complaint' => $complaint]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'solved_date' => 'nullable|date',
            'status' => 'required|in:dikirim,proses,done',
        ]);

        // Temukan complaint berdasarkan ID
        $complaint = Complaint::findOrFail($id);

        // Update data complaint
        $complaint->update([
            'solved_date' => $request->input('solved_date'),
            'status' => $request->input('status'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('dept.index')->with('success', 'Complaint updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
