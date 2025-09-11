<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->hasRole('admin')) {
                return redirect()->route('admin.index');
            } elseif (Auth::user()->hasRole('pegawai')) {
                return redirect()->route('pegawai.index');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function showUpdatePassword()
    {
        return view('auth.update-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email'            => 'required|email',
            'current_password' => 'required',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // cek apakah email sesuai
        if ($request->email !== $user->email) {
            return back()->withErrors([
                'email' => 'Email tidak sesuai dengan akun Anda.',
            ]);
        }

        // cek password lama
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.',
            ]);
        }

        // update password baru
        $user->password = \Hash::make($request->new_password);
        $user->save();

        return back()->with('status', 'Password berhasil diperbarui.');
    }
}
