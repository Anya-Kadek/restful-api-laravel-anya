<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();

        $totalRevenue = Order::where('status', 'Selesai')
            ->sum('total');

        $pendingOrders = Order::where(
            'status',
            'Menunggu Konfirmasi'
        )->count();

        $latestOrders = Order::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'latestOrders'
        ));
    }
}