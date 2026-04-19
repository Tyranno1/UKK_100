<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    // 1. Validasi Input Sesuai Database Kita
    $request->validate([
        'nis_nip' => ['required', 'string', 'max:255', 'unique:' . User::class], // Ganti Email jadi NIS
        'name' => ['required', 'string', 'max:255'],
        'kelas' => ['required', 'string', 'max:10'], // Tambah Validasi Kelas
        'telp' => ['required', 'string', 'max:15'],  // Tambah Validasi Telp
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);
    // 2. Simpan Data ke Database
    $user = User::create([
        'nis_nip' => $request->nis_nip,
        'name' => $request->name,
        'kelas' => $request->kelas,
        'telp' => $request->telp,
        'level' => 'siswa', // Default yang daftar sendiri pasti SISWA
        'password' => Hash::make($request->password),
    ]);
    event(new Registered($user));
    Auth::login($user);
    return redirect(route('siswa.dashboard', absolute: false));
}
}
