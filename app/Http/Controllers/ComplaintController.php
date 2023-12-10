<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is logged in
        if ($user) {
            // Fetch complaints for the logged-in user
            $complaints = Complaint::where('username', $user->name)->get();

            // Pass the complaints to the view
            return view('complaint.index', compact('complaints'));
        } else {
            // Handle the case where the user is not logged in
            return redirect()->route('login'); // Redirect to the login page, for example
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \I   lluminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role_id', 3)->get();
        return view('complaint.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'username' => 'required|string',
            'department_name' => 'required|string',
            'department_destination' => 'required|string',
            'no_workorder' => 'required|string',
            'complaint_date' => 'required|date',
            'solved_date' => 'nullable|date',
            'complaint_type' => 'required|in:ringan,sedang,berat',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|string',
        ]);

        // Upload photo if provided
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints/photos', 'public');
        }

        // Create new complaint
        Complaint::create([
            'username' => $request->input('username'),
            'department_name' => $request->input('department_name'),
            'department_destination' => $request->input('department_destination'),
            'no_workorder' => $request->input('no_workorder'),
            'complaint_date' => $request->input('complaint_date'),
            'solved_date' => $request->input('solved_date'),
            'complaint_type' => $request->input('complaint_type'),
            'description' => $request->input('description'),
            'photo' => $photoPath,
            'status' => $request->input('status'),
        ]);

        // Redirect to the complaints index or another desired page
        return redirect('/complaints');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        // Tampilkan detail pengaduan
        return view('complaint.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        // Tampilkan formulir untuk mengedit pengaduan
        return view('complaint.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'departement_name' => 'required',
            'no_wo' => 'required',
            'tanggal' => 'required',
            'jenis_complaint' => 'required',
            'keterangan' => 'required',
            'foto' => 'required',
        ]);

        // Perbarui pengaduan ke database
        $complaint->update($request->all());

        // Redirect ke halaman daftar pengaduan
        return redirect()->route('complaint.index')
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {

        $complaint = Complaint::find($id);
        if ($complaint) {
            $complaint->delete();

            return redirect()->route('complaints.index')
                ->with('success', 'Pengaduan berhasil dihapus!');
        } else {
            return redirect()->route('complaints.index')
                ->with('error', 'Gagal menghapus pengaduan. Data tidak ditemukan atau sudah dihapus sebelumnya.');
        }
    }
}
