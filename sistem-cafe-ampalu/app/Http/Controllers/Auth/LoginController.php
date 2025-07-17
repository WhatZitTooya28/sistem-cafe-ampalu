<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|string',
        ]);

        // Coba login dengan email, password, DAN role
if (Auth::attempt($credentials)) {
    $request->session()->regenerate();
    $user = Auth::user();

    // Arahkan berdasarkan peran
    if ($user->role == 'admin' || $user->role == 'dapur') {
        return redirect()->intended('/admin/menu');
    } elseif ($user->role == 'kasir') {
        return redirect()->intended('/kasir/dashboard'); // <-- Tujuan baru untuk kasir
    }

    return redirect('/'); // Redirect default
}

        // Jika login gagal, kembali dengan pesan error
        return back()->withErrors([
            'email' => 'Kombinasi Email, Password, dan Jabatan tidak cocok.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
