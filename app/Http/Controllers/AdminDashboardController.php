<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Mengambil data admin yang sedang login untuk banner selamat datang
        $adminInfo = Auth::user();

        // Menghitung statistik global sistem
        $totalUsers = User::count();
        $totalBooks = Book::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $uptime = $this->getSystemUptime();

        // Menghitung rata-rata rating dari seluruh pesanan yang sudah diulas di platform
        $averageRating = Order::whereNotNull('rating')->avg('rating') ?? 0;

        // Menghitung persentase perubahan pendapatan (Contoh logika sederhana dibanding bulan lalu)
        $currentMonthRevenue = Order::where('status', 'completed')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('total');
        $lastMonthRevenue = Order::where('status', 'completed')->whereMonth('created_at', date('m', strtotime('-1 month')))->whereYear('created_at', date('Y'))->sum('total');
        $earningsChange = $lastMonthRevenue > 0 ? (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;

        // Mengambil 5 transaksi terbaru di platform untuk tabel
        $latestOrders = Order::with(['buyer', 'book'])->latest()->take(5)->get();

        // Mengambil daftar buku yang stoknya menipis/kritis secara global untuk komponen kontrol stok
        $lowStockBooks = Book::where('stock', '<=', 10)->orderBy('stock', 'asc')->get();

        // DATA DINAMIS BAR CHART MANUAL (Performa Mingguan Global 7 Hari Terakhir)
        $weeklyBars = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $dayName = date('D', strtotime($date));

            // Hitung pendapatan hari tersebut
            $dayRevenue = Order::where('status', 'completed')->whereDate('created_at', $date)->sum('total');
            // Simulasi skala tinggi batang (Max Rp 5.000.000 dianggap 100%)
            $earningHeight = min(($dayRevenue / 5000000) * 100, 100);

            // Tinggi bar pengunjung diset konstan atau acak sebagai pelengkap estetika dashboard murni tanpa Chart.js
            $weeklyBars[$dayName] = [
                'visitor_height' => rand(30, 85),
                'earning_height' => $dayRevenue > 0 ? max($earningHeight, 15) : 0
            ];
        }

        return view('dashboard.admin.dashboard', compact(
            'adminInfo',
            'totalUsers', 
            'totalBooks', 
            'totalRevenue', 
            'uptime',
            'averageRating',
            'earningsChange',
            'latestOrders',
            'lowStockBooks',
            'weeklyBars'
        ));
    }

    private function getSystemUptime()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return "Tersedia di server Linux";
        }
        $str = @file_get_contents('/proc/uptime');
        if ($str === false) {
            return "Tidak dapat memuat data uptime";
        }
        $num = floatval($str);
        $secs = fmod($num, 60); $num = intval($num / 60);
        $mins = fmod($num, 60); $num = intval($num / 60);
        $hours = fmod($num, 24); $num = intval($num / 24);
        $days = $num;

        return "{$days} Hari, {$hours} Jam, {$mins} Menit";
    }
}