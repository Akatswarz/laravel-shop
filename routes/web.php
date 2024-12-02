<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [HomeController::class, 'contact']);

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/view-cart', [CartController::class, 'view']);
Route::get('/totalProductsInCart', [CartController::class, 'totalProductsInCart']);
Route::post('/add-cart', [CartController::class, 'add']);
Route::post('/update-cart', [CartController::class, 'update']);
Route::post('/remove-cart', [CartController::class, 'remove']);

Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function (){
    Route::get('/checkout/sendEmail', [CheckoutController::class, 'sendEmail'])->name('checkout.sendEmail');
});
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/product', [AdminProductController::class, 'index'])
        ->middleware('throttle:10,1')
        ->name('admin.product');
    Route::get('/product-edit/{id}', [AdminProductController::class, 'editForm'])->name('admin.product.editForm');
    Route::post('/product-edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::get('/product-add', [AdminProductController::class, 'addForm'])->name('admin.product.addForm');
    Route::post('/product-add', [AdminProductController::class, 'add'])->name('admin.product.add');
    Route::get('/product-remove/{id}', [AdminProductController::class, 'remove'])->name('admin.product.remove');
});

Route::get('/category/{slug}/{id}', [ProductController::class, 'list']);
Route::get('/product/{cat}-{p?}', [ProductController::class, 'index']);
Route::get('/{cat}/{slug}', [ProductController::class, 'detail']);




