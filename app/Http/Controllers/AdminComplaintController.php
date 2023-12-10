<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\DB;

class AdminComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::all();
        return view('admin.complaint.index', compact('complaints'));
        // return "HAII";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.complaint.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            // Sesuaikan dengan aturan validasi yang dibutuhkan
        ]);

        // Simpan data ke database
        Complaint::create([
            // Sesuaikan dengan kolom-kolom yang ada pada model Complaint
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('a_complaint.index')->with('success', 'Complaint added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('admin.complaint.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('admin.complaint.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            // Sesuaikan dengan aturan validasi yang dibutuhkan
        ]);

        // Update data di database
        $complaint = Complaint::findOrFail($id);
        $complaint->update([
            // Sesuaikan dengan kolom-kolom yang ada pada model Complaint
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('a_complaint.index')->with('success', 'Complaint updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Hapus data dari database
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('a_complaint.index')->with('success', 'Complaint deleted successfully');
    }

    public function indexReport(Request $request)
    {
        if ($request->has('start_date') && $request->has('end_date') && $request->has('department_name')) {
            // Validasi input
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'department_name' => 'required|string',
            ]);

            // Ambil data pengaduan berdasarkan rentang tanggal dan department_name
            if ($request->department_name === 'all') {
                // Jika 'all' dipilih, ambil semua data tanpa membatasi berdasarkan departemen
                $complaintsReport = Complaint::whereBetween('complaint_date', [$request->start_date, $request->end_date])
                    ->get();
            } else {
                // Ambil data berdasarkan rentang tanggal dan department_name yang dipilih
                $complaintsReport = Complaint::whereBetween('complaint_date', [$request->start_date, $request->end_date])
                    ->where('department_name', $request->department_name)
                    ->get();
            }

            // Pengecekan apakah $complaintsReport kosong
            if ($complaintsReport->isEmpty()) {

                return view('admin.complaint.indexReport')->with('message', 'Tidak ada data yang ditemukan');
            }

            // Kirim data ke view
            return view('admin.complaint.indexReport', compact('complaintsReport'));
        }

        // Jika formulir belum dikirim, tampilkan formulir pencarian saja
        return view('admin.complaint.indexReport');
    }
}
