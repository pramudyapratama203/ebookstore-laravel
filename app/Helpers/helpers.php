<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('format_rupiah')) {
    function format_rupiah(int $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

if (!function_exists('current_user')) {
    function current_user()
    {
        return Auth::user();
    }
}

if (!function_exists('is_admin')) {
    function is_admin(): bool
    {
        return Auth::check() && Auth::user()->role === 'admin';
    }
}

if (!function_exists('is_seller')) {
    function is_seller(): bool
    {
        return Auth::check() && Auth::user()->role === 'seller';
    }
}

if (!function_exists('is_buyer')) {
    function is_buyer(): bool
    {
        return Auth::check() && Auth::user()->role === 'buyer';
    }
}