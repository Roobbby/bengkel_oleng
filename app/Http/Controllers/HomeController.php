<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function Index()
    {
        return view('front.index');
    }

    public function Dashboard() {
        
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        // Periksa apakah pengguna sudah lengkap atau belum
        // $user = Auth::user();
    
        // if ($user->role == 2 && (
        //     empty($user->name) || 
        //     empty($user->email)||
        //     empty($user->telp) ||
        //     empty($user->gender) ||
        //     empty($user->alamat)
        //     )) {
        //     // Data pengguna belum lengkap, atur pesan alert
        //     session()->flash('warning', 'Harap lengkapi data diri Anda terlebih dahulu.');
        //     return redirect()->route('profile');
        // }
    
        // // Jika data sudah lengkap, tampilkan halaman dashboard
        return view('back.home');
    }

    public function Haut(){
        return view ('front.index');
    }

    public function HautUser($domain_user){
        return view ('front.index');
    }
}
