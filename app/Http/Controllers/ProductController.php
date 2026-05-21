<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class ProductController extends Controller
{
public function admin()
{
    $totalOrderHariIni = Order::whereDate('created_at', today())->count();

    $pendapatanHariIni = Order::whereDate('created_at', today())
        ->where('status', 'Selesai')
        ->sum('total');

    $selesaiHariIni = Order::whereDate('created_at', today())
        ->where('status', 'Selesai')
        ->count();

    $labelsGrafik = [];
    $dataGrafik = [];

    for ($i = 6; $i >= 0; $i--) {
        $tanggal = now()->subDays($i);

        $labelsGrafik[] = $tanggal->translatedFormat('D');

        $dataGrafik[] = Order::whereDate('created_at', $tanggal)
            ->where('status', 'Selesai')
            ->sum('total');
    }

    return view('admin', compact(
        'totalOrderHariIni',
        'pendapatanHariIni',
        'selesaiHariIni',
        'labelsGrafik',
        'dataGrafik'
    ));
}
public function index()
{
$products = Product::all();

return view('product.index', compact('products'));
}    
public function create()
{
 return view('product.create');
}

public function destroy($id)
{
    $product = Product::findOrFail($id);

    $product->delete();

    return redirect('/product')
        ->with('success', 'Produk berhasil dihapus');
}

public function store(Request $request)
{
    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'discount' => $request->discount ?? 0,
        'best_seller' => $request->best_seller ? true : false,
        'stock' => $request->stock,
        'description' => $request->description,
        'image' => $imagePath,
        'category' => $request->category,
    ]);

    return redirect('/product')->with('success', 'Produk berhasil ditambah');
}
public function edit($id)
{
    $product = Product::findOrFail($id);

    return view('product.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $imagePath = $product->image;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    $product->update([
        'name' => $request->name,
        'price' => $request->price,
        'discount' => $request->discount,
        'best_seller' => $request->best_seller ? true : false,
        'stock' => $request->stock,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    return redirect('/product')->with('success', 'Produk berhasil diupdate');
}
public function menu()
{
    $products = Product::all();

    return view('menu', compact('products'));
}
public function addToCart($id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $discount = $product->discount ?? 0;
        $finalPrice = max($product->price - $discount, 0);
        $cart[$id] = [
        'name' => $product->name,
        'price' => $finalPrice,
        'normal_price' => $product->price,
        'discount' => $discount,
        'image' => $product->image,
        'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    return redirect('/cart')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
}

public function cart()
{
    $cart = session()->get('cart', []);

    return view('cart', compact('cart'));
}
public function increaseCart($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    }

    session()->put('cart', $cart);

    return redirect('/cart');
}

public function decreaseCart($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {

        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } else {
            unset($cart[$id]);
        }
    }

    session()->put('cart', $cart);

    return redirect('/cart');
}

public function removeCart($id)
{
    $cart = session()->get('cart');

    if (isset($cart[$id])) {
        unset($cart[$id]);
    }

    session()->put('cart', $cart);

    return redirect('/cart');
}
public function checkout(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect('/cart');
    }

    $total = 0;

    // CEK STOK DULU
    foreach ($cart as $productId => $item) {
        $product = Product::findOrFail($productId);

        if ($product->stock < $item['quantity']) {
            return redirect('/cart')
                ->with('error', 'Stok ' . $product->name . ' tidak cukup!');
        }

        $total += $item['price'] * $item['quantity'];
    }

    $order = Order::create([
        'customer_name' => $request->customer_name,
        'total' => $total,
        'payment_method' => $request->payment_method,
        'status' => 'Pending',
    ]);

    foreach ($cart as $productId => $item) {
        $product = Product::findOrFail($productId);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'product_name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'subtotal' => $item['price'] * $item['quantity'],
        ]);

        // KURANGI STOK OTOMATIS
        $product->stock -= $item['quantity'];
        $product->save();
    }

    session()->forget('cart');

    return redirect('/order-success/' . $order->id);
}
public function orderSuccess($id)
{
    $order = Order::with('items')->findOrFail($id);

    return view('order-success', compact('order'));
}
public function kasirOrders()
{
    $orders = Order::with('items')
        ->whereDate('created_at', today())
        ->whereNull('closed_at')
        ->latest()
        ->get();

    return view('kasir.orders', compact('orders'));
}
public function ordersLive()
{
    $orders = Order::with('items')
        ->whereDate('created_at', today())
        ->whereNull('closed_at')
        ->latest()
        ->get();

    return view('kasir.partials.order-list', compact('orders'));
}
public function closeToday()
{
    Order::whereDate('created_at', today())
        ->whereNull('closed_at')
        ->update([
            'closed_at' => now()
        ]);

    return redirect('/kasir/orders')
        ->with('success', 'Order hari ini berhasil di-close.');
}

public function doneOrder($id)
{
    $order = Order::findOrFail($id);

    $order->update([
        'status' => 'Selesai',
    ]);

    return redirect('/kasir/orders');
}
public function updateOrderStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $order->update([
        'status' => $request->status,
    ]);

    return redirect('/kasir/orders');
}
public function orderStatusLive($id)
{
    $order = Order::findOrFail($id);

    return view('kasir.partials.order-status-live', compact('order'));
}
}