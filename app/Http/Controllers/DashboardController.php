<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function buyer()
    {
        $orders = Order::where('buyer_id', Auth::id())
            ->with('book')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('dashboard.buyer', compact('orders'));
    }

    public function sellerDashboard()
    {
        $user = Auth::user();
        $books = Book::where('seller_id', $user->id)->get();
        $categories = Category::all();

        $totalEarnings = Order::whereHas('book', function($q) use ($user) {
            $q->where('seller_id', $user->id);
        })->sum('total');

        $earningsThisMonth = Order::whereHas('book', function($q) use ($user) {
            $q->where('seller_id', $user->id);
        })
        ->whereMonth('created_at', \Carbon\Carbon::now()->month)
        ->whereYear('created_at', \Carbon\Carbon::now()->year)
        ->sum('total');

        $earningsLastMonth = Order::whereHas('book', function($q) use ($user) {
                $q->where('seller_id', $user->id);
            })
            ->whereMonth('created_at', \Carbon\Carbon::now()->subMonth()->month)
            ->whereYear('created_at', \Carbon\Carbon::now()->subMonth()->year)
            ->sum('total');

        if ($earningsLastMonth > 0) {
            $earningsChange = (($earningsThisMonth - $earningsLastMonth) / $earningsLastMonth) * 100;
        } else {
            $earningsChange = $earningsThisMonth > 0 ? 100 : 0;
        }

        $ratings = $books->pluck('rating');
        $averageRating = $ratings->count() > 0 ? $ratings->avg() : 0;

        $orders = Order::whereHas('book', function($q) use ($user) {
                $q->where('seller_id', $user->id);
            })
            ->with(['buyer', 'book']) 
            ->orderByDesc('id')
            ->get();
        
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $chartData = [];

        foreach ($daysOfWeek as $day) {
            $earning = Order::whereHas('book', function($q) use ($user) {
                    $q->where('seller_id', $user->id);
                })
                ->whereRaw("DAYNAME(created_at) = ?", [$day])
                ->sum('total');
        
            $visitor = $earning > 0 ? rand(10, 30) : rand(1, 5);

            $chartData[$day] = [
                'earning' => $earning,
                'visitor' => $visitor
            ];
        }

        $maxEarning = max(array_column($chartData, 'earning')) ?: 1;
        $maxVisitor = max(array_column($chartData, 'visitor')) ?: 1;

        $weeklyBars = [];
        foreach ($daysOfWeek as $day) {
            $shortName = substr($day, 0, 3); 
            $weeklyBars[$shortName] = [
                'earning_height' => ($chartData[$day]['earning'] / $maxEarning) * 100,
                'visitor_height' => ($chartData[$day]['visitor'] / $maxVisitor) * 100,
            ];
        }        
        return view('dashboard.seller.home', compact('user', 'books', 'categories', 'totalEarnings', 'earningsChange', 'averageRating', 'orders', 'weeklyBars'));
    }

    public function admin()
    {
        $userCount = \App\Models\User::count();
        $bookCount = Book::count();
        $orderCount = Order::count();

        $recentOrders = Order::with('book', 'buyer')
            ->orderByDesc('id')
            ->take(10)
            ->get();

        return view('dashboard.admin', compact('userCount', 'bookCount', 'orderCount', 'recentOrders'));
    }
}