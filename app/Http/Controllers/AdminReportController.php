<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class AdminReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'department_name' => 'required|string',
        ]);

        // Ambil data pengaduan berdasarkan rentang tanggal dan department_name
        $complaintsReport = Complaint::whereBetween('complaint_date', [$request->start_date, $request->end_date])
            ->where('department_name', $request->department_name)
            ->get();

        // Kirim data ke view
        return view('admin.report.index', compact('complaintsReport'));

        // return "HALLO ";
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
