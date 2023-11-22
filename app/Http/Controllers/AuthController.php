<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function Register()
    {
        $role = 'user'; 
        return view('back.auth.register', compact('role'));
    }

    public function RegisterOnline()
    {
        return view('back.auth.register_on');
    }

    public function RegisterOffline()
    {
        return view ('back.auth.register_off');    
    }

    public function RegisterOnlineStore(Request $request)
    {
         $validateUser = $request->validate([
            'sapaan' => 'required|max:50',
            'panggilan' => 'required|max:50',
            'name' => 'required|max:100',
            'telp' => 'required|unique:users',
            'email' => 'required|unique:users',
            'role' => 'required|integer',
            'status' => 'required|integer',
            'password' => 'required',
         ]);
         
        
        $user = new User([
            'sapaan' => $validateUser['sapaan'],
            'panggilan' => $validateUser['panggilan'],
            'name' => $validateUser['name'],
            'telp' => $validateUser['telp'], 
            'email' => $validateUser['email'],
            'password' => Hash::make($validateUser['password']),
            'role' => $validateUser['role'],
            'status' => $validateUser['status'],
        ]);
        
        // Simpan user
        $userSaved = $user->save();
        
        if ($userSaved) {
            $newUserId = $user->id;
            $newUserDomain = 'bengkel_' . $user['panggilan'];
        
            $domain = new Domain([
                'user_id' => $newUserId,
                'domain_user' => $newUserDomain,
            ]);
        
            // Simpan domain
            $domainSaved = $domain->save();
        
            if ($domainSaved) {
                // Berhasil disimpan
                session()->flash('alert', 'success');
                session()->flash('message', 'Registrasi berhasil. Silakan login.');
                return redirect()->route('login');
            } else {
                // Gagal menyimpan domain
                session()->flash('alert', 'error');
                session()->flash('message', 'Terjadi kesalahan saat menyimpan domain.');
                return back();
            }
        } else {
            // Gagal menyimpan user
            session()->flash('alert', 'error');
            session()->flash('message', 'Terjadi kesalahan saat menyimpan pengguna.');
            return back();
        }
        
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
            session()->flash('alert', 'success');
            session()->flash('message', 'Registrasi berhasil. Silakan login.');
            return redirect()->route('login');
    
        } catch (ValidationException $e) {
            $errors = $e->errors();
            // Registrasi gagal, kembalikan ke halaman registrasi dengan pesan error
            return back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            // Terjadi kesalahan, kembalikan ke halaman registrasi dengan pesan error
            session()->flash('alert', 'error');
            session()->flash('message', 'Terjadi kesalahan. Silakan coba lagi.');
            return back();
        }
    }
    
    
    public function ActionLogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($data)) {
            $user = Auth::user();
        
            if ($user->role == 2) {
                // Pastikan user memiliki properti domain sebelum me-redirect
                if ($user->domain) {
                    return redirect()->route('dashboard.user', ['id' => $user->domain->id]);
                } else {
                    // Handle jika user tidak memiliki domain
                    return redirect()->route('login')->with('error', 'User tidak memiliki domain terkait.');
                }
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            session()->flash('alert', 'error');
            session()->flash('message', 'Email atau password salah. Silakan coba lagi.');
            return redirect()->back();
        }
    }

    public function Logout(Request $request)
    {
        Auth::guard('web')->logout();
        session()->flash('alert', 'error');
        session()->flash('message', 'You are logged out!!!.');
        return redirect()->route('login');
    }
    
    // tidak terpakai
    // public function checkUsernameAvailability(Request $request)
    // {
    //     $username = $request->input('username');

    //     // Cek apakah username sudah ada di database
    //     $user = User::where('username', $username)->first();

    //     if ($user) {
    //         // Username sudah terpakai
    //         return response()->json(['available' => false]);
    //     } else {
    //         // Username tersedia
    //         return response()->json(['available' => true]);
    //     }
    // }
  
    public function checkWhatsApps(Request $request) {
        $telp = $request->input('telp');

        // Cek apakah username sudah ada di database
        $telp = User::where('telp', $telp)->first();

        if ($telp) {
            // Username sudah terpakai
            return response()->json(['available' => false]);
        } else {
            // Username tersedia
            return response()->json(['available' => true]);
        }
    }

    public function checkEmails(Request $request){
        $email = $request->input('email');

        // Cek apakah username sudah ada di database
        $email = User::where('email', $email)->first();

        if ($email) {
            // Username sudah terpakai
            return response()->json(['available' => false]);
        } else {
            // Username tersedia
            return response()->json(['available' => true]);
        }
    }

    // $data =  User::find($telp);
    public function ResetPassword(Request $request){
        $request->validate([
            'telp' => 'required|exists:users,telp'
        ]);
    
        // Cek apakah nomor telepon ada di database
        $user = User::where('telp', $request->telp)->first();
    
        // Jika ada, tampilkan formulir reset password
        return view('back.auth.reset_password', compact('user'));
    }
    
    public function ResetPasswordLink(){
        // Tampilkan formulir reset password tanpa data pengguna
        return view ('back.auth.reset_password');
    }

    public function resetpass(){

    }
    
    

}
