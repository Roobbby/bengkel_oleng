<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class SuperAdminController extends Controller
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
        $data = User::where('role', 0)->orderBy('created_at', 'desc')->get();
        return view('back.superadmin.super_admin_manage',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.superadmin.create_super_admin'); 
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
        ]);
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['email'] = $request -> email;
        $data['username'] = $request -> username;
        $data['name'] = $request -> name;
        $data['role'] = $request -> role;
        $data['password'] = Hash::make($request -> password);
        User::create($data);
        return redirect()->route('superadmin.index');
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
        return view('back.superadmin.edit', compact('data'));
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

        return redirect()->route('superadmin.index')->with($notification);
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
        return redirect()->route('superadmin.index');
    }

    public function toggleStatus(Request $request, $id)
    {
        $sadmin = User::find($id);

        if ($sadmin) {
            // Ubah status
            $sadmin->status = $sadmin->status == 0 ? 1 : 0;
            $sadmin->save();

            $notification = array(
                'message' => 'Update Status Berhasil',
                'alert-type' => 'success'
            );

            return redirect()->route('superadmin.index')->with($notification );
        }

        $notification = array(
            'message' => 'Update Status Gagal',
            'alert-type' => 'error'
        );

        return redirect()->route('superadmin.index')->with($notification);
    }
}
