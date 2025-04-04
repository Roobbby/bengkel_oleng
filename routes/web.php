<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;

use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ItemsController;
use Illuminate\Support\Facades\Artisan;

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

//Menjalankan Storage link diserver
Route::get('/buat-storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link berhasil dibuat!';
});


Route::get('/', function () {
    return redirect('/bengkel_oleng');
});

//Auth Routes
Route::get('/bengkel_oleng', [HomeController::class, 'Haut'])->name('haut');
Route::get('/register/online', [AuthController::class, 'RegisterOnline'])->name('register.online');
Route::post('/register/online/store', [AuthController::class, 'RegisterOnlineStore'])->name('register.online.store');
Route::get('/register/offline', [AuthController::class, 'RegisterOffline'])->name('register.offline');
Route::get('/register', [AuthController::class, 'Register'])->name('register');
Route::post('/register/store', [AuthController::class, 'RegisterStore'])->name('register.store');
Route::get('/login', [AuthController::class, 'Login'])->name('login');
Route::post('/actionlogin', [AuthController::class, 'ActionLogin'])->name('actionlogin');
Route::post('/check-whatsapps', [AuthController::class, 'checkWhatsApps'])->name('checkWhatsApps');
Route::post('/check-emails', [AuthController::class, 'checkEmails'])->name('checkEmails');
Route::post('/reset-passwords', [AuthController::class, 'ResetPassword'])->name('reset.pass');
Route::get('/reset-password', [AuthController::class, 'ResetPasswordLink'])->name('reset.password');
Route::post('/reset-pass', [AuthController::class, 'resetpass'])->name('reset.passwords');


Route::middleware(['auth', 'PreventBackHistory', 'role:1,2'])->group(function () {
    Route::get('/dashboard/user', [UserController::class, 'DashboardUser'])->name('dashboard.user');

    //Route::get('/profile/id', [UserController::class, 'ProfileBengkel'])->name('profile.bengkel');

    Route::get('/profile/com', [UserController::class, 'ProfileCom'])->name('profile.com');
    Route::get('/cosuser', [UserController::class, 'CosUser'])->name('cos.user');
    Route::get('/profile/com/edit', [UserController::class, 'ProfileComEdit'])->name('profile.com.edit');
    Route::post('/profile/com/store', [UserController::class, 'ProfileComStore'])->name('profile.com.store');

    Route::get('/pos-base', [UserController::class, 'PosBase'])->name('pos.base');
    Route::resource('carts', CartController::class);

    Route::resource('products', ProductController::class);
    
    Route::resource('transactions', TransactionController::class);
});

Route::get('/users/{domain_user}', [HomeController::class, 'HautUser'])->name('haut.user');

Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
    Route::get('/home', [HomeController::class, 'Index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'Dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'Profile'])->name('profile');
    Route::post('/profile/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/change/password', [ProfileController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [ProfileController::class, 'UpdatePassword'])->name('update.password');
    Route::post('/check-old-password', [ProfileController::class, 'checkOldPassword'])->name('check.old_password');
    Route::post('/checks-whatsapp', [ProfileController::class, 'checksWhatsApp'])->name('checksWhatsApp');
    Route::post('/checks-email', [ProfileController::class, 'checksEmail'])->name('checksEmail');
    Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');
});

Route::middleware(['auth', 'PreventBackHistory', 'role:0,1'])->group(function () {
    //super admin manage
    Route::get('/manage/superadmin', [SuperAdminController::class, 'Index'])->name('manage.super.admin');
    Route::resource('superadmin', SuperAdminController::class);
    Route::patch('/superadmin/toggle-status/{id}', [SuperAdminController::class, 'toggleStatus'])->name('superadmin.toggleStatus');
});

Route::middleware(['auth', 'PreventBackHistory', 'role:0,1'])->group(function () {
    //admin manage
    Route::get('/manage/admin', [AdminController::class, 'Index'])->name('manage.admin');
    Route::patch('/admin/toggle-status/{id}', [AdminController::class, 'toggleStatus'])->name('admin.toggleStatus');
    Route::resource('admin', AdminController::class);

    Route::get('/manage/user', [UserController::class, 'Index'])->name('manage.user');
    Route::patch('/user/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');
    Route::resource('user', UserController::class);

    Route::post('/check-whatsapp', [UserController::class, 'checkWhatsApp'])->name('checkWhatsApp');
    Route::post('/check-email', [UserController::class, 'checkEmail'])->name('checkEmail');
    Route::get('/transaction', [UserController::class, 'transaction'])->name('transaction');
    Route::get('/whatsapp-admin', [UserController::class, 'whatsappadmin'])->name('whatsapp.admin');

    Route::resource('categories', CategoryController::class);
});
