<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogoutController extends Controller
{
    /**
     * Handle the logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-page')->with('status', 'Anda telah berjaya log keluar.');
    }
}
