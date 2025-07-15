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

            // Ambil data pengguna yang sedang login
            $user = Auth::user();

            // Cek peran pengguna dan arahkan ke halaman yang sesuai
            if ($user->role == 'dapur' || $user->role == 'admin') {
                return redirect()->intended('/admin/menu');
            }

            // Jika perannya adalah kasir, arahkan ke dashboard kasir (nanti)
            if ($user->role == 'kasir') {
                // Untuk sekarang, kita arahkan ke halaman utama saja
                return redirect('/'); 
            }

            // Redirect default jika tidak ada peran yang cocok
            return redirect('/');
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
