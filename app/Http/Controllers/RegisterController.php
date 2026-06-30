<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ], [
            'name.required' => 'Sila masukkan nama penuh anda.',
            'email.required' => 'Sila masukkan alamat emel.',
            'email.email' => 'Alamat emel tidak sah.',
            'email.unique' => 'Emel ini telah didaftarkan.',
            'password.required' => 'Sila masukkan kata laluan.',
            'password.min' => 'Kata laluan mesti sekurang-kurangnya 8 aksara.',
            'password.confirmed' => 'Pengesahan kata laluan tidak sepadan.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Automatically log in the user after registration
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran berjaya!');
    }
}
