<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Order;
use App\Models\AdminActivityLog;
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

        // DATA DINAMIS BAR CHART (Performa Mingguan 7 Hari Terakhir)
        $weeklyBars = [];
        $rawWeeklyData = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw("DATE(created_at) as date, SUM(total) as revenue, COUNT(*) as order_count")
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get()
            ->keyBy('date');

        $maxRevenue = max($rawWeeklyData->max('revenue') ?: 0, 1);
        $maxOrders = max($rawWeeklyData->max('order_count') ?: 0, 1);

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayName = now()->subDays($i)->format('D');
            $dayData = $rawWeeklyData->get($date);
            $dayRevenue = (int) ($dayData->revenue ?? 0);
            $dayOrders = (int) ($dayData->order_count ?? 0);

            $weeklyBars[$dayName] = [
                'order_count' => $dayOrders,
                'revenue' => $dayRevenue,
                'earning_height' => $dayRevenue > 0 ? max(($dayRevenue / $maxRevenue) * 100, 10) : 0,
                'order_height' => $dayOrders > 0 ? max(($dayOrders / $maxOrders) * 100, 10) : 0,
            ];
        }

        AdminActivityLog::log('view', 'dashboard', 'Admin melihat dashboard');

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

    public function activityLogs(Request $request)
    {
        $query = AdminActivityLog::with('user');

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('module', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($action = $request->get('action')) {
            $query->where('action', $action);
        }

        if ($module = $request->get('module')) {
            $query->where('module', $module);
        }

        if ($date_from = $request->get('date_from')) {
            $query->whereDate('created_at', '>=', $date_from);
        }

        if ($date_to = $request->get('date_to')) {
            $query->whereDate('created_at', '<=', $date_to);
        }

        $logs = $query->latest()->paginate(20)->withQueryString();

        $actions = AdminActivityLog::select('action')->distinct()->pluck('action');
        $modules = AdminActivityLog::select('module')->distinct()->pluck('module');

        AdminActivityLog::log('view', 'activity-logs', 'Admin melihat log aktivitas');

        return view('dashboard.admin.activity-logs', compact('logs', 'actions', 'modules'));
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