<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use DB;


class AuthController extends Controller
{
    public function Register()
    {
        $role = 'user'; 
        return view('back.auth.register', compact('role'));
    }

    public function Login()
    {
       return view('back.auth.login');
    }

    public function RegisterStore(Request $request)
    {   
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|unique:users',
                'password' => 'required',
                'role' => 'required|integer', 
            ]);
    
            $validatedData['password'] = Hash::make($validatedData['password']);
    
            $user = new User([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'role' => $validatedData['role'],
            ]);
            
            $user->save();
    
            // Registrasi berhasil, arahkan ke halaman login dengan pesan sukses
            return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    
        } catch (ValidationException $e) {
            $errors = $e->errors();
            // Registrasi gagal, kembalikan ke halaman registrasi dengan pesan error
            return back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            // Terjadi kesalahan, kembalikan ke halaman registrasi dengan pesan error
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }
    
    
    public function ActionLogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect('dashboard');
        }else{
            return redirect()->back()->with('error', 'Terjadi Kesalahan. Silakan coba lagi.');
        }
    }

    public function Logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('fail', 'You are logged out!!!');
    }
    
    public function checkUsernameAvailability(Request $request)
    {
        $username = $request->input('username');

        // Cek apakah username sudah ada di database
        $user = User::where('username', $username)->first();

        if ($user) {
            // Username sudah terpakai
            return response()->json(['available' => false]);
        } else {
            // Username tersedia
            return response()->json(['available' => true]);
        }
    }

}
