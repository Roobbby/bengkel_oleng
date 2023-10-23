<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Index()
    {
         // Pastikan pengguna sudah terotentikasi
         if (!Auth::check()) {
            // Jika belum terotentikasi, arahkan ke halaman login dengan pesan notifikasi
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }
        // $data = User::where('role', '2')
        // ->with('domain')
        // ->orderBy('created_at', 'desc');
        $data = User::with('domain')->orderBy('created_at', 'desc')->get();


        return view('back.users.user_manage',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.users.create_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'sapaan' => 'required|max:50',
            'panggilan' => 'required|max:50',
            'name' => 'required|max:100',
            'telp' => 'required|unique:users',
            'email' => 'required|unique:users',
            'role' => 'required|integer',
            'password' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $data = [
            'sapaan' => $request->sapaan,
            'panggilan' => $request->panggilan,
            'name' => $request->name,
            'telp' => $request->telp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];
        
        // Simpan user
        $userSaved = User::create($data);
        
        if ($userSaved) {
            // Sekarang, user baru telah disimpan, dan ID-nya sudah ada
            $newUserId = $userSaved->id;
        
            // Buat domain dengan user_id yang sesuai
            $domain = new Domain([
                'user_id' => $newUserId,
            ]);
        
            // Coba menyimpan domain
            $domainSaved = $domain->save();
        }
        
        // Penanganan kesalahan
        if ($userSaved && $domainSaved) {
            session()->flash('alert', 'success');
            session()->flash('message', 'Registrasi berhasil. Silakan login.');
            return redirect()->route('user.index');
        }
        
        
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data =  User::find($id);
        return view('back.users.edit_user', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            ],[
                'name.required' => 'Nama wajib disi',
                'email.required' => 'Email Perusahaan wajib disi',
                'username.required' => 'Username Mulai wajib disi',
            ]
        );

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
        ];
        User::where('id', $id)->update($data);

        $notification = array(
            'message' => 'Edit Data User Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);

        if($data){
            $data->delete();
        }
    return redirect()->route('user.index');
    }

    public function toggleStatus(Request $request, $id)
    {
        $user = Auth::user($id);

        if ($user) {
            // Ubah status
            $user->status = $user->status == 0 ? 1 : 0;
            $user->save();

            $notification = array(
                'message' => 'Update Status Berhasil',
                'alert-type' => 'success'
            );

            return redirect()->route('user.index')->with($notification);
        }

        $notification = array(
            'message' => 'Update Status Gagal',
            'alert-type' => 'error'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function checkWhatsApp(Request $request) {
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

    public function checkEmail(Request $request){
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
}
