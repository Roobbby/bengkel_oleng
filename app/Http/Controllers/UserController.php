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
         if (!Auth::check()) {
           
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
        
        $userSaved = User::create($data);
        
        if ($userSaved) {
            
            $newUserId = $userSaved->id;
            $newUserDomain = 'bengkel_' . $data['name'];

            $domain = new Domain([
                'user_id' => $newUserId,
                'domain_user' => $newUserDomain
            ]);
               
            $domainSaved = $domain->save();
        }
        
      
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
            'sapaan' => 'required',
            'panggilan' => 'required',
            'name' => 'required',
            'email' => 'required',
            ],[
                'sapaan.required' => 'Sapaan Mulai wajib diganti',
                'panggilan.required' => 'Panggilan Wajib diganti',
                'name.required' => 'Nama wajib diganti',
                'email.required' => 'Email Perusahaan wajib diganti',
            ]
        );

        $data = [
            'sapaan'=>$request->sapaan,
            'panggilan'=>$request->panggilan,
            'name'=>$request->name,
            'email'=>$request->email,
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
            
            $user->status = $user->status == 0 ? 1 : 0;
            $user->save();

            
            $notification = array(
                'message' => 'Update Status Berhasil',
                'alert-type' => 'success'
            );

            return redirect()->route('user.index')->with($notification);
        }

    }
    // $notification = array(
    //     'message' => 'Update Status Gagal',
    //     'alert-type' => 'error'
    // );

    // return redirect()->route('user.index')->with($notification);

    public function checkWhatsApp(Request $request) {
        $telp = $request->input('telp');

        $telp = User::where('telp', $telp)->first();

        if ($telp) {
          
            return response()->json(['available' => false]);
        } else {
           
            return response()->json(['available' => true]);
        }
    }

    public function checkEmail(Request $request){
        $email = $request->input('email');

        $email = User::where('email', $email)->first();

        if ($email) {
           
            return response()->json(['available' => false]);
        } else {
      
            return response()->json(['available' => true]);
        }
    }

    //redirect Url

    public function ProfileCom(){
        
        $user = Auth::user();
        $domain = $user->domain;

        return view('back.users.profile_com', ['domain_user' => $domain]);
    }

    public function DashboardUser($domain_user){
        $user = Auth::user();
        // $domain = $user->domain;
        
        return view('back.users.dashboard_user', ['domain_user' => $domain_user]);

    }
    
    public function ProfileBengkel(){


    }

}
