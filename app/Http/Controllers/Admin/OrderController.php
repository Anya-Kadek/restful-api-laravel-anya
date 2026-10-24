<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($order)
    {
        $order = Order::with('items')
            ->findOrFail($order);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $order)
    {
        $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'Menunggu Konfirmasi',
                    'Diproses',
                    'Dikirim',
                    'Selesai',
                    'Dibatalkan',
                ]),
            ],
        ]);

        $order = Order::findOrFail($order);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }
}