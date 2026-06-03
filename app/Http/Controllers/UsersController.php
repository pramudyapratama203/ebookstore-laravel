<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('welcome', compact('users'));
    }

    public function showUserProfile()
    {
        $user = auth()->user();

        return view('profile.buyer.showprofile', compact('user'));
    }

    public function showSellerProfile()
    {
        $user = auth()->user();

        return view('profile.seller.showprofile', compact('user'));
    }
}
