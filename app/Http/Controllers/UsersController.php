<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('welcome', compact('users'));
    }

    public function showUserProfile()
    {
        $user = auth()->user()->load('profile');

        return view('profile.buyer.showprofile', compact('user'));
    }

    public function showSellerProfile()
    {
        $user = auth()->user()->load('profile');

        return view('profile.seller.showprofile', compact('user'));
    }

    public function showAdminProfile()
    {
        $user = auth()->user()->load('profile');

        return view('profile.admin.showprofile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($request->only('name', 'email'));

        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only('phone')
        );

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroyAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password yang dimasukkan tidak sesuai!');
        }

        Auth::logout();

        $user->delete();

        return redirect('/login')->with('success', 'Akun berhasil dihapus.');
    }
}
