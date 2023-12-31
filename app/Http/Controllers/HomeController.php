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

    public function HautUser($domain_user){
    
    $domain_user = Domain::where('domain_user',$domain_user)->first();
    return view('front.index_user', ['domain_user' => $domain_user]);
    
    }
    

    
}
