<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('frontpage.landingpage', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('frontpage.detail', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity < 1) {
            return back()->with('error', 'Jumlah produk minimal 1.');
        }

        if ($quantity > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok yang tersedia.');
        }

        $cart = session()->get('cart', []);
        $productId = $product->product_id;

        $currentQuantity = $cart[$productId]['quantity'] ?? 0;

        if ($currentQuantity + $quantity > $product->stock) {
            return back()->with('error', 'Jumlah di keranjang melebihi stok.');
        }

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'product_id' => $product->product_id,
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'img' => $product->img,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function cartView()
    {
        $cart = session()->get('cart', []);

        return view('frontpage.cart', compact('cart'));
    }

    public function checkoutView()
    {
        $cart = session()->get('cart', []);

        return view('frontpage.checkout', compact('cart'));
    }

    public function checkoutProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')
                ->with('error', 'Keranjang masih kosong.');
        }

        session()->forget('cart');

        return redirect('/dashboard')
            ->with('success', 'Pesanan berhasil dibuat! Terima kasih sudah berbelanja di Anya Pastry and Dessert.');
    }
}
