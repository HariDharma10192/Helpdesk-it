<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        // Apply the middleware check only to the 'index' method
        $this->middleware(function ($request, $next) {
            // Check if the user has the required role
            if (Auth::user()->role_id != 1) {
                return redirect('/')->with('error', 'Unauthorized access');
            }

            return $next($request);
        })->only('index');
    }
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in the database.
     */
    public function store(Request $request)
    {
        // Validasi form tambah pengguna
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Simpan pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        // Redirect ke halaman daftar pengguna dengan pesan sukses
        return redirect()->route('users')->with('success', 'User added successfully!');
    }


    /**
     * Display the specified user.
     */
    public function show($id)
    {
        // Lakukan operasi yang diperlukan untuk menampilkan informasi user
        // Misalnya, ambil data user dari database berdasarkan $id
        $user = User::find($id);

        // Kemudian lewatkan data user ke view atau lakukan operasi lainnya
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit($id)
    {
        $user = user::find($id);
        $roles = Role::all();

        return view('admin.users.edit', compact(['user', 'roles']));
    }

    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        $user->update($request->except(['_token', 'submit']));


        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,',
        //     'password' => 'nullable|string|min:8|confirmed',
        //     'role_id' => 'required|exists:roles,id',
        // ], [
        //     'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
        // ]);

        // // Update user information
        // $user->fill([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'role_id' => $request->role_id,
        // ]);

        // // Update password if provided
        // if ($request->filled('password')) {
        //     $user->password = bcrypt($request->password);
        // }

        // Save the changes
        $user->save();

        return redirect()->route('admin.users.show', $user->id)
            ->with('success', 'User updated successfully!');
    }





    /**
     * Update the specified user in the database.
     */
    // public function update(Request $request, User $user)
    // {
    //     // Validation rules for updating a user
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255|unique:users,email,' . $user->id,
    //         'password' => 'nullable|min:6',
    //         'role_id' => 'required|exists:roles,id',
    //     ]);

    //     // Update the user
    //     $user->update($request->all());

    //     return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    // }

    /**
     * Remove the specified user from the database.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users')->with('success', 'User deleted successfully');
    }
}
