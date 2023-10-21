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
            'sapaan' => 'required',
            'panggilan' => 'required',
            'name' => 'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $user = new User;
        $user->sapaan = $request->sapaan;
        $user->panggilan = $request->panggilan;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        $domain = new Domain;
        $domain->id_user = $user->id; 
        $domain->save();

        return redirect()->route('user.index');
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
        $user = User::find($id);

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
}
