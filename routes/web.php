<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect('/admin');
    }

    return redirect('/menu');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ROUTE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', function () {
        $totalOrderHariIni = Order::whereDate('created_at', today())->count();

        $pendingHariIni = Order::whereDate('created_at', today())
            ->where('status', 'Pending')
            ->count();

        $selesaiHariIni = Order::whereDate('created_at', today())
            ->where('status', 'Selesai')
            ->count();

        $pendapatanHariIni = Order::whereDate('created_at', today())
            ->where('status', 'Selesai')
            ->sum('total');

        $labelsGrafik = [];
        $dataGrafik = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = now()->subDays($i);

            $labelsGrafik[] = $tanggal->translatedFormat('D');

            $dataGrafik[] = Order::whereDate('created_at', $tanggal)
                ->where('status', 'Selesai')
                ->sum('total');
            $recentOrders = Order::with('items')
            ->latest()
            ->take(5)
            ->get();
            $bestSeller = DB::table('order_items')
            ->select('product_name', DB::raw('SUM(quantity) as total'))
            ->groupBy('product_name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

            $pieLabels = $bestSeller->pluck('product_name');
            $pieData = $bestSeller->pluck('total');
        }

        return view('admin', compact(
            'totalOrderHariIni',
            'pendingHariIni',
            'selesaiHariIni',
            'pendapatanHariIni',
            'labelsGrafik',
            'dataGrafik',
            'recentOrders',
            'pieLabels',
            'pieData',
        ));
    });

    Route::get('/admin/orders', function () {
        $orders = Order::with('items')
            ->latest()
            ->get();

        return view('admin-orders', compact('orders'));
    });

    Route::get('/admin/laporan', function () {
        $orders = Order::with('items')
            ->where('status', 'Selesai')
            ->latest()
            ->get();

        $totalPendapatan = $orders->sum('total');
        $totalOrders = $orders->count();

        $menuTerlaris = DB::table('order_items')
            ->select('product_name', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_name')
            ->orderByDesc('total_qty')
            ->take(5)
            ->get();

        return view('laporan', compact(
            'orders',
            'totalPendapatan',
            'totalOrders',
            'menuTerlaris'
        ));
    });

    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/create', [ProductController::class, 'create']);
    Route::post('/product/store', [ProductController::class, 'store']);
    Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

});

/*
|--------------------------------------------------------------------------
| ROUTE USER / CUSTOMER
|--------------------------------------------------------------------------
*/
Route::get('/menu', [ProductController::class, 'menu']);
Route::post('/cart/add/{id}', [ProductController::class, 'addToCart']);
Route::get('/cart', [ProductController::class, 'cart']);
Route::post('/cart/increase/{id}', [ProductController::class, 'increaseCart']);
Route::post('/cart/decrease/{id}', [ProductController::class, 'decreaseCart']);
Route::delete('/cart/remove/{id}', [ProductController::class, 'removeCart']);
Route::post('/checkout', [ProductController::class, 'checkout']);
Route::get('/order-success/{id}', [ProductController::class, 'orderSuccess']);
Route::get('/order-status-live/{id}', [ProductController::class, 'orderStatusLive']);

Route::get('/success', function () {
    return view('success');
});

/*
|--------------------------------------------------------------------------
| ROUTE KASIR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/kasir/orders', [ProductController::class, 'kasirOrders']);
    Route::get('/kasir/orders-live', [ProductController::class, 'ordersLive']);
    Route::post('/kasir/orders/{id}/done', [ProductController::class, 'doneOrder']);
    Route::post('/kasir/orders/{id}/status', [ProductController::class, 'updateOrderStatus']);
    Route::post('/kasir/orders/close-today', [ProductController::class, 'closeToday']);

});

require __DIR__.'/auth.php';