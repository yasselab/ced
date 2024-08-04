<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EtudiantAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('etudiant.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'cin' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('etudiant')->attempt(['cin' => $request->cin, 'password' => $request->password])) {
            return redirect()->intended('/etudiant/dashboard');
        }

        return back()->withErrors([
            'cin' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function logout()
    {
        Auth::guard('etudiant')->logout();
        return redirect()->route('etudiant.login');
    }
}

