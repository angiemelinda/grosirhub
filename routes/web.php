<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ShippingController;
// DROPSHIPPER
use App\Http\Controllers\Dropshipper\DashboardController;
use App\Http\Controllers\Dropshipper\ProductController as DropshipperProductController;
use App\Http\Controllers\Dropshipper\OrderController;
use App\Http\Controllers\Dropshipper\PaymentController;
use App\Http\Controllers\Dropshipper\TransactionController;
use App\Http\Controllers\MidtransCallbackController;

// ADMIN
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Models\User;
use App\Http\Controllers\Supplier\ProdukController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Supplier\PesananController;
use App\Http\Controllers\Supplier\ProfilController;

// ============================================
// PUBLIC ROUTES
// ============================================

// Landing Page - redirect ke dashboard jika sudah login
Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/produk', function () {
    return view('product');
})->name('product');

Route::get('/supplier', function () {
    return view('supplier');
})->name('supplier');

Route::get('/cara_kerja', function () {
    return view('cara_kerja');
})->name('cara_kerja');

Route::get('/kontak', function () {
    return view('kontak'); 
})->name('kontak');

// ============================================
// AUTHENTICATION ROUTES
// ============================================

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('auth.forgot-password');

// ============================================
// SUPERADMIN ROUTES
// ============================================

Route::middleware(['auth', 'role:super_admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    
    Route::get('/suppliers', [SuperAdminController::class, 'suppliers'])->name('suppliers');
    
    Route::get('/dropshippers', [SuperAdminController::class, 'dropshippers'])->name('dropshippers');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    
    Route::get('/transactions', [SuperAdminController::class, 'transactions'])->name('transactions');
    
    Route::get('/reports', [SuperAdminController::class, 'reports'])->name('reports');

    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});

// ============================================
// ADMIN PRODUK ROUTES
// ============================================

Route::middleware(['auth', 'role:admin_produk'])->prefix('adminproduk')->name('adminproduk.')->group(function () {
    Route::get('/dashboard', function () {
        return view('adminproduk.dashboard');
    })->name('dashboard');
    
    Route::get('/products', [AdminProductController::class, 'index'])->name('products');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    
    Route::get('/stock', function () {
        return view('adminproduk.stock');
    })->name('stock');
});

// ============================================
// ADMIN PENGGUNA ROUTES
// ============================================

Route::middleware(['auth', 'role:admin_pengguna'])->prefix('adminpengguna')->name('adminpengguna.')->group(function () {
    Route::get('/dashboard', function () {
        return view('adminpengguna.dashboard');
    })->name('dashboard');
    
    Route::get('/suppliers', function () {
        return view('adminpengguna.suppliers');
    })->name('suppliers');
    
    Route::get('/dropshippers', function () {
        return view('adminpengguna.dropshippers');
    })->name('dropshippers');
});

// ============================================
// ADMIN TRANSAKSI ROUTES
// ============================================

Route::middleware(['auth', 'role:admin_transaksi'])->prefix('admintransaksi')->name('admintransaksi.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admintransaksi.dashboard');
    })->name('dashboard');
    
    Route::get('/all-transactions', function () {
        return view('admintransaksi.all-transactions');
    })->name('all-transactions');
    
    Route::get('/confirmation', function () {
        return view('admintransaksi.confirmation');
    })->name('confirmation');
});

// ============================================
// ADMIN LAPORAN ROUTES
// ============================================

Route::middleware(['auth', 'role:admin_laporan'])->prefix('adminlaporan')->name('adminlaporan.')->group(function () {
    Route::get('/dashboard', function () {
        return view('adminlaporan.dashboard');
    })->name('dashboard');
    
    Route::get('/sales-report', function () {
        return view('adminlaporan.sales-report');
    })->name('sales-report');
    
    Route::get('/supplier-report', function () {
        return view('adminlaporan.supplier-report');
    })->name('supplier-report');
});

// ============================================
// SUPPLIER ROUTES
// ============================================
// ============================================
// SUPPLIER ROUTES
// ============================================
Route::middleware(['auth', 'role:supplier'])->prefix('supplier')->name('supplier.')->group(function () {

    // 1. Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Supplier\DashboardController::class, 'index'])->name('dashboard');

    // 2. Resource Produk
    Route::resource('produk', ProdukController::class);
    Route::get('/my-products', [ProdukController::class, 'index'])->name('my-products');

    // 3. MENU ORDER MASUK
    Route::get('/order-masuk', [PesananController::class, 'orderMasuk'])->name('order.masuk');
    Route::post('/order/{id}/konfirmasi', [PesananController::class, 'konfirmasiProses'])->name('order.konfirmasi');

    // JALUR PENYELAMAT (Agar dashboard tidak error saat klik 'Lihat Semua')
    Route::get('/pesanan', [PesananController::class, 'orderMasuk'])->name('pesanan.index');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');

    // 4. MENU PENGIRIMAN
    Route::get('/pengiriman', [PesananController::class, 'pengiriman'])->name('pengiriman');
    Route::post('/order/{id}/resi', [PesananController::class, 'inputResi'])->name('order.input_resi');

    // 5. MENU RIWAYAT
    Route::get('/riwayat', [PesananController::class, 'riwayat'])->name('riwayat');

    // 6. MENU PENDAPATAN (YANG TADI EROR)
    // Pastikan baris ini ada:
    Route::get('/earnings', [\App\Http\Controllers\Supplier\EarningsController::class, 'index'])->name('earnings');

    // Profil & Pengaturan
    Route::get('/profil', [\App\Http\Controllers\Supplier\ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [\App\Http\Controllers\Supplier\ProfilController::class, 'update'])->name('profil.update');
    Route::get('/password', [\App\Http\Controllers\Supplier\ProfilController::class, 'editPassword'])->name('password.change');
    Route::put('/password', [\App\Http\Controllers\Supplier\ProfilController::class, 'updatePassword'])->name('password.update');
    Route::get('/pengaturan', fn () => view('supplier.pengaturan.index'))->name('pengaturan');

});

// ============================================
// DROPSHIPPER ROUTES
// ============================================
// ============================================
// DROPSHIPPER ROUTES
// ============================================

Route::middleware(['auth', 'role:dropshipper'])->prefix('dropshipper')->name('dropshipper.')->group(function () {
    
    // Dashboard & Profil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/tracking', [DashboardController::class, 'tracking'])->name('tracking');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');

    // Katalog
    Route::get('/catalog', [DropshipperProductController::class, 'index'])->name('catalog');
    Route::get('/product/{id}', [DropshipperProductController::class, 'show'])->name('product.show');
    
    // Pesanan
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/order/{id}', [OrderController::class, 'orderShow'])->name('order.show');
    Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order-history');
    Route::post('/orders/{id}/complete', [OrderController::class, 'completeOrder'])
            ->name('order.complete');
    Route::post('/order/{id}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('dropshipper.order.confirm');
    

    
    // === KERANJANG BELANJA (YANG DIPERBAIKI) ===
    Route::get('/cart', [OrderController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
    
    // Rute Baru untuk Update & Hapus
    Route::patch('/cart/update', [OrderController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove', [OrderController::class, 'removeFromCart'])->name('cart.remove');

    // Checkout

    // Alur Checkout Baru
    Route::match(['get', 'post'], '/checkout', [OrderController::class, 'checkoutPage'])->name('checkout'); // Ke Halaman Upload
    Route::post('/payment/process', [OrderController::class, 'processPayment'])->name('payment.process'); // Proses Upload & Simpan

    // API Dummy
    Route::get('/api/tracking/{resi}', [\App\Http\Controllers\Dropshipper\ShippingController::class, 'track'])->name('api.tracking');
});

// ============================================
// LEGACY ROUTES (for backward compatibility)
// ============================================

// Old admin routes - redirect to new structure
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/super-admin', function () {
        return redirect()->route('superadmin.dashboard');
    })->name('admin.dashboard');
    
    Route::get('/super-admin/produk', function () {
        return redirect()->route('superadmin.products');
    })->name('admin.products');
    
    Route::get('/super-admin/kategori', function () {
        return redirect()->route('superadmin.categories');
    })->name('admin.categories');
    
    Route::get('/super-admin/pengguna', function () {
        return redirect()->route('superadmin.users');
    })->name('admin.users');
    
    Route::get('/super-admin/transaksi', function () {
        return redirect()->route('superadmin.transactions');
    })->name('admin.transactions');
    
    Route::get('/super-admin/supplier', function () {
        return redirect()->route('superadmin.suppliers');
    })->name('admin.suppliers');
    
    Route::get('/super-admin/dropshipper', function () {
        return redirect()->route('superadmin.dropshippers');
    })->name('admin.dropshippers');
});

Route::post('/midtrans/callback', 
    [MidtransCallbackController::class, 'handle']
);
// --- JALUR PENYELAMAT: ISI KATEGORI OTOMATIS ---
Route::get('/isi-kategori', function() {
    $kategori = ['Fashion', 'Elektronik', 'Kecantikan', 'Makanan', 'Peralatan Rumah', 'Mainan'];
    
    foreach($kategori as $nama) {
        \App\Models\Category::firstOrCreate(['name' => $nama]);
    }
    
    return "BERHASIL! Kategori sudah dibuat. Silakan kembali ke menu Produk dan coba lagi.";
});
// --- JALUR DARURAT: KLAIM SEMUA PRODUK ---
Route::get('/claim-all-products', function() {
    if (!auth()->check()) {
        return "Login sebagai Supplier dulu!";
    }
    
    $user = auth()->user();
    
    // Ubah semua produk di database menjadi milik user yang sedang login
    \App\Models\Product::query()->update(['user_id' => $user->id]);
    
    return "BERHASIL! Semua produk sekarang menjadi milik: " . $user->name . ". Silakan refresh halaman Order Masuk.";
});
// --- JALUR DARURAT: GENERATE DATA DUMMY UNTUK PRESENTASI ---
Route::get('/buat-data-presentasi', function() {
    $user = Illuminate\Support\Facades\Auth::user();
    if(!$user) return "Login dulu sebagai dropshipper!";

    // Pastikan ada minimal 1 produk (buat dummy jika kosong)
    $product = \App\Models\Product::first();
    if(!$product) {
        $product = \App\Models\Product::create([
            'user_id' => 1, 'category_id' => 1, 'name' => 'Produk Contoh', 
            'slug' => 'produk-contoh', 'price' => 100000, 'stock' => 100, 
            'description' => 'Desc', 'status' => 'active'
        ]);
    }

    // 1. Buat 2 Pesanan DIKEMAS (Processing)
    for($i=0; $i<2; $i++) {
        $o = \App\Models\Order::create([
            'user_id' => $user->id, 'order_code' => 'ORD-PACK-'.rand(100,999),
            'total' => 150000, 'status' => 'processing', 'payment_status' => 'paid',
            'payment_method' => 'BCA', 'margin' => 0
        ]);
        \App\Models\OrderItem::create(['order_id'=>$o->id, 'product_id'=>$product->id, 'quantity'=>2, 'price'=>75000, 'subtotal'=>150000]);
    }

    for($i=0; $i<2; $i++) {
        $o = \App\Models\Order::create([
            'user_id' => $user->id, 'order_code' => 'ORD-SHIP-'.rand(100,999),
            'total' => 200000, 'status' => 'shipping', 'payment_status' => 'paid',
            'payment_method' => 'GoPay', 'resi' => 'JP'.rand(10000000,99999999), 'margin' => 0
        ]);
        \App\Models\OrderItem::create(['order_id'=>$o->id, 'product_id'=>$product->id, 'quantity'=>1, 'price'=>200000, 'subtotal'=>200000]);
    }

    // 3. Buat 3 Pesanan SELESAI (Completed) -> Masuk Riwayat
    for($i=0; $i<3; $i++) {
        $o = \App\Models\Order::create([
            'user_id' => $user->id, 'order_code' => 'ORD-DONE-'.rand(100,999),
            'total' => 350000, 'status' => 'completed', 'payment_status' => 'paid',
            'payment_method' => 'Dana', 'resi' => 'JP'.rand(10000000,99999999), 'margin' => 0
        ]);
        \App\Models\OrderItem::create(['order_id'=>$o->id, 'product_id'=>$product->id, 'quantity'=>5, 'price'=>70000, 'subtotal'=>350000]);
    }

    return redirect()->route('dropshipper.orders')->with('success', 'Data Presentasi Berhasil Dibuat! Cek tab Dikemas, Dikirim, dan Menu Riwayat.');
});

// Route untuk mengubah status jadi Selesai (Tombol Terima Pesanan)
Route::get('/terima-pesanan/{id}', function($id) {
    \App\Models\Order::where('id', $id)->update(['status' => 'completed']);
    return redirect()->back()->with('success', 'Pesanan Diterima! Masuk ke Riwayat.');
})->name('dropshipper.order.complete');
// --- JALUR KHUSUS: GENERATE DATA PRESENTASI ---
Route::get('/data-presentasi', function() {
    $user = Illuminate\Support\Facades\Auth::user();
    if(!$user) return "Silakan login sebagai dropshipper terlebih dahulu.";

    // 1. Pastikan ada minimal 1 produk (buat baru jika kosong)
    $product = \App\Models\Product::first();
    if(!$product) {
        $product = \App\Models\Product::create([
            'user_id' => 1, // Asumsi ID admin/supplier
            'category_id' => 1, 
            'name' => 'Produk Demo Presentasi', 
            'slug' => 'produk-demo', 
            'price' => 150000, 
            'stock' => 999, 
            'description' => 'Produk contoh untuk keperluan presentasi.', 
            'status' => 'active'
        ]);
    }

    // ... kode produk di atas biarkan sama ...

    // 2. Buat 2 Pesanan DIKEMAS
    // PERBAIKAN: Mengganti 'processing' menjadi 'pending' (atau 'paid' sesuaikan db)
    for($i=1; $i<=2; $i++) {
        $o = \App\Models\Order::create([
            'user_id' => $user->id, 
            'order_code' => 'ORD-2024-KM-' . rand(100,999),
            'total' => 150000, 
            'status' => 'pending', // <--- GANTI INI DARI 'processing' KE 'pending'
            'payment_status' => 'paid',
            'payment_method' => 'BCA Virtual Account', 
            'margin' => 0
        ]);
        \App\Models\OrderItem::create(['order_id'=>$o->id, 'product_id'=>$product->id, 'quantity'=>1, 'price'=>150000, 'subtotal'=>150000]);
    }

    // ... sisa kode ke bawah biarkan sama ...
    // 3. Buat 2 Pesanan DIKIRIM (Status: Shipping)
    for($i=1; $i<=2; $i++) {
        $o = \App\Models\Order::create([
            'user_id' => $user->id, 
            'order_code' => 'ORD-2024-KR-' . rand(100,999),
            'total' => 300000, 
            'status' => 'shipping', 
            'payment_status' => 'paid',
            'payment_method' => 'GoPay', 
            'resi' => 'JP' . rand(1000000000,9999999999), 
            'margin' => 0
        ]);
        \App\Models\OrderItem::create(['order_id'=>$o->id, 'product_id'=>$product->id, 'quantity'=>2, 'price'=>150000, 'subtotal'=>300000]);
    }

    // 4. Buat 3 Pesanan SELESAI (Status: Completed) -> Untuk Riwayat
    for($i=1; $i<=3; $i++) {
        $o = \App\Models\Order::create([
            'user_id' => $user->id, 
            'order_code' => 'ORD-2024-SL-' . rand(100,999),
            'total' => 450000, 
            'status' => 'completed', 
            'payment_status' => 'paid',
            'payment_method' => 'Mandiri Virtual Account', 
            'resi' => 'JP' . rand(1000000000,9999999999), 
            'margin' => 0
        ]);
        \App\Models\OrderItem::create(['order_id'=>$o->id, 'product_id'=>$product->id, 'quantity'=>3, 'price'=>150000, 'subtotal'=>450000]);
    }

    return redirect()->route('dropshipper.orders')->with('success', 'Data Presentasi Siap! Silakan cek tab Dikemas, Dikirim, dan Riwayat.');
});

// Route untuk mengubah status jadi Selesai (Tombol Terima Pesanan)
Route::get('/selesaikan-pesanan/{id}', function($id) {
    \App\Models\Order::where('id', $id)->update(['status' => 'completed']);
    return redirect()->back()->with('success', 'Pesanan Diterima! Data masuk ke Riwayat.');
})->name('dropshipper.order.complete');