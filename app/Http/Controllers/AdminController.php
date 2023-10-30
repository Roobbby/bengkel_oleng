<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminController extends Controller
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
        $data = User::where('role', '1')->orderBy('created_at', 'desc')->get();
        return view('back.admin.admin_manage',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('back.admin.create_admin');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'name' => 'required',
            'username' => 'required',
            'password'=>'required',
            'foto' => 'required',
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['email'] = $request -> email;
        $data['username'] = $request -> username;
        $data['name'] = $request -> name;
        $data['foto'] = $request -> foto;
        $data['role'] = $request -> role;
        $data['password'] = Hash::make($request -> password);
        User::create($data);
        return redirect()->route('admin.index')->with('succes', 'Berhasil Mengubah data');
    }

    public function toggleStatus(Request $request, $id)
    {
        $admin = User::find($id);

        if ($admin) {
            // Ubah status
            $admin->status = $admin->status == 0 ? 1 : 0;
            $admin->save();

            $notification = array(
                'message' => 'Update Status Berhasil',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.index')->with($notification);
        }
            $notification = array(
                'message' => 'Update Status Gagal',
                'alert-type' => 'error'
            );

        return redirect()->route('admin.index')->with($notification);
    }
    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $data =  User::find($id);
        return view('back.admin.edit_admin', compact('data'));
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
                'username.required' => 'Username wajib disi',
            ]
        );

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'username'=>$request->username,
        ];
        User::where('id', $id)->update($data);

        $notification = array(
            'message' => 'Edit Data Admin Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.index')->with($notification);
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
        return redirect()->route('admin.index');
    }


    
}
