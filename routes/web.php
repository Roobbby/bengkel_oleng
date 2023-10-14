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
    Route::get('/register', [AuthController::class, 'Register'])->name('register');
    Route::get('/register/user', [AuthController::class, 'RegisterUser'])->name('register.user');
    Route::post('/register/user/store',[AuthController::class, 'RegisterUserStore'])->name('register.user.store');
    Route::post('/register/store', [AuthController::class, 'RegisterStore'])->name('register.store');
    Route::get('/login', [AuthController::class, 'Login'])->name('login');
    Route::post('/actionlogin', [AuthController::class, 'ActionLogin'])->name('actionlogin');
    Route::post('/check-username-availability', [AuthController::class, 'checkUsernameAvailability'])->name('checkUsernameAvailability');


Route::middleware(['auth','PreventBackHistory'])->group(function(){
    Route::get('/home', [HomeController::class, 'Index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'Dashboard'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'Profile'])->name('profile');
    Route::post('/profile/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/change/password', [ProfileController::class, 'ChangePassword'])->name('change.password');
    Route::post('/update/password', [ProfileController::class, 'UpdatePassword'])->name('update.password');
    Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');
 

    //super admin manage
    Route::get('/manage/superadmin', [SuperAdminController::class, 'Index'])->name('manage.super.admin');
    Route::resource('superadmin', SuperAdminController::class);
    Route::patch('/superadmin/toggle-status/{id}', [SuperAdminController::class,'toggleStatus'])->name('superadmin.toggleStatus');

    //admin manage
    Route::get('/manage/admin', [AdminController::class, 'Index'])->name('manage.admin');
    Route::resource('admin', AdminController::class);
    Route::patch('/admin/toggle-status/{id}', [AdminController::class,'toggleStatus'])->name('admin.toggleStatus');
    
    //user manage
    Route::get('/manage/user', [UserController::class, 'Index'])->name('manage.user');
    Route::resource('user', UserController::class);
    Route::patch('/user/toggle-status/{id}', [UserController::class,'toggleStatus'])->name('user.toggleStatus');
    
 
}); 

