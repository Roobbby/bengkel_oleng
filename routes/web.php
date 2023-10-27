<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return redirect('/bengkel_oleng');
});

    //Auth Routes
    Route::get('/bengkel_oleng', [HomeController::class, 'Haut'])->name('haut');
    Route::get('/register/online', [AuthController::class, 'RegisterOnline'])->name('register.online');
    Route::post('/register/online/store',[AuthController::class, 'RegisterOnlineStore'])->name('register.online.store');
    Route::get('/register/offline',[AuthController::class, 'RegisterOffline'])->name('register.offline');
    Route::get('/register', [AuthController::class, 'Register'])->name('register');
    Route::post('/register/store', [AuthController::class, 'RegisterStore'])->name('register.store');
    Route::get('/login', [AuthController::class, 'Login'])->name('login');
    Route::post('/actionlogin', [AuthController::class, 'ActionLogin'])->name('actionlogin');
    Route::post('/check-username-availability', [AuthController::class, 'checkUsernameAvailability'])->name('checkUsernameAvailability');
    Route::post('/check-whatsapp', [AuthController::class, 'checkWhatsApp'])->name('checkWhatsApp');
    Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('checkEmail');
    
    Route::middleware(['auth','PreventBackHistory'])->group(function(){
        Route::get('/home', [HomeController::class, 'Index'])->name('home');
        Route::get('/dashboard', [HomeController::class, 'Dashboard'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'Profile'])->name('profile');
        Route::post('/profile/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
        Route::get('/change/password', [ProfileController::class, 'ChangePassword'])->name('change.password');
        Route::post('/update/password', [ProfileController::class, 'UpdatePassword'])->name('update.password');
        Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');
    }); 
    
    Route::middleware(['auth','PreventBackHistory', 'role:0'])->group(function(){
        //super admin manage
        Route::get('/manage/superadmin', [SuperAdminController::class, 'Index'])->name('manage.super.admin');
        Route::resource('superadmin', SuperAdminController::class);
        Route::patch('/superadmin/toggle-status/{id}', [SuperAdminController::class,'toggleStatus'])->name('superadmin.toggleStatus');
    });
    
    Route::middleware(['auth','PreventBackHistory' , 'role:0,1'])->group(function(){
        //admin manage
        Route::get('/manage/admin', [AdminController::class, 'Index'])->name('manage.admin');
        Route::resource('admin', AdminController::class);
        Route::patch('/admin/toggle-status/{id}', [AdminController::class,'toggleStatus'])->name('admin.toggleStatus');
        Route::patch('/user/toggle-status/{id}', [UserController::class,'toggleStatus'])->name('user.toggleStatus');
        Route::get('/manage/user', [UserController::class, 'Index'])->name('manage.user');
        Route::resource('user', UserController::class);
        Route::post('/check-whatsapp', [UserController::class, 'checkWhatsApp'])->name('checkWhatsApp');
        Route::post('/check-email', [UserController::class, 'checkEmail'])->name('checkEmail');
    });
    
    
    Route::middleware(['auth','PreventBackHistory', 'role:2'])->group(function(){
        //user manage
        Route::get('/{domain_user}/dashboard', [UserController::class, 'DashboardUser'])->name('dashboard.user');
        Route::get('/{domain_user}/profile', [UserController::class, 'ProfileBengkel'])->name('profile.bengkel');
        Route::get('/{domain_user}/user', [Usercontroller::class, 'ProfileCom'])->name('profile.com');
    });   
 

