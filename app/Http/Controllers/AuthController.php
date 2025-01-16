<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Wyświetlanie formularza logowania
    public function showLoginForm()
    {
        return view('login');
    }

    // Obsługa logowania
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Przekierowanie na podstawie roli użytkownika
            if ($user->role_id == 1) {
                return redirect('/admin');
            } elseif ($user->role_id == 2) {
                return redirect('/employee');
            } elseif ($user->role_id == 3) {
                return redirect('/client');
            }

            return redirect('/')->with('error', 'Nieprawidłowa rola użytkownika.');
        }

        return redirect('/login')->withErrors(['email' => 'Nieprawidłowe dane logowania.']);
    }

    // Wylogowanie
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    // Wyświetlanie formularza rejestracji
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Obsługa rejestracji
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string', // Akceptuj dowolne hasło oprócz pustego
        ]);

        try {
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 3, // Domyślna rola: klient
            ]);

            Auth::login($user);

            return redirect('/client');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Nie udało się zarejestrować użytkownika.']);
        }
    }
}
