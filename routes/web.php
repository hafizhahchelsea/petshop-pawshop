<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// User Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;

// Admin Controllers
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReviewController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'home'])->name('landing');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

/*
|--------------------------------------------------------------------------
| USER AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER PROTECTED ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    
    // Cart & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');

    // Alur Pembayaran User
    Route::get('/payment', function (Request $request) {
        return view('payment', [
            'nama' => $request->query('nama'),
            'phone' => $request->query('phone'),
            'alamat' => $request->query('alamat'),
        ]);
    })->name('payment.index');

    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    
    // Post Review
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (Protected by Middleware Admin)
|--------------------------------------------------------------------------
*/
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard & Statistics
    Route::get('/dashboard', [AdminController::class, 'orders'])->name('dashboard');

    // Order Management (Pesanan)
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateStatus'])->name('orders.update');
    Route::get('/payments', [AdminController::class, 'pembayaran'])->name('payments');

    // Product Management
    Route::get('/menu', [ProductController::class, 'index'])->name('menu');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/menu/edit/{id}', [ProductController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/update/{id}', [ProductController::class, 'update'])->name('menu.update');
    Route::delete('/menu/delete/{id}', [ProductController::class, 'destroy'])->name('menu.delete');

    // User Management
    Route::get('/users', [UserManagementController::class, 'index'])->name('users');
    Route::get('/users/accept/{id}', [UserManagementController::class, 'accept'])->name('users.accept');
    Route::get('/users/reject/{id}', [UserManagementController::class, 'reject'])->name('users.reject');

    // Review Management
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews');
    Route::post('/reviews/{id}/status', [AdminReviewController::class, 'updateStatus'])->name('reviews.status');
    Route::delete('/reviews/{id}', [AdminReviewController::class, 'delete'])->name('reviews.delete');
});