<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use App\Models\Costumer;
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
        $user = Auth::user();

        return view('back.home', compact('user'));
    }

    public function Haut(){
        return view ('front.index');
    }

    // public function HautUser(){
    
    // $domain_user = Domain::value('domain_user');

    // return redirect()->route('haut.user', ['domain_user' => $domain_user]);
    // }
    
    public function HautUser(){
        // Ambil domain terkait dengan pengguna saat ini
        $domain_user = optional(auth()->user()->domain)->domain_user;
    
        // Jika domain_user tidak null, redirect ke halaman dengan parameter domain_user
        if ($domain_user) {
            return redirect()->route('haut.user', ['domain_user' => $domain_user]);
        } else {
            // Handle jika pengguna tidak memiliki domain
            return redirect()->back()->with('error', 'User tidak memiliki domain terkait.');
        }
    }
    
}
