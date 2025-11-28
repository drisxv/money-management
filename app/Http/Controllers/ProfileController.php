<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\UserService;

use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function edit()
    {
        $user = Auth::user();
        return view('update_profile', compact('user'));
    }
    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $this->userService->update($user, $validated);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui');
    }
    public function security()
    {
        $user = Auth::user();
        return view('update_keamanan', compact('user'));
    }
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok'])->withInput();
        }

        $this->userService->updatePassword($user, $validated['password']);

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui');
    }
}
