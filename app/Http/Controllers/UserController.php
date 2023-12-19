<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domain;
use App\Models\Item;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
            'status' => 'required|integer',
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
            'status' => $request->status,
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
            session()->flash('message', 'Registrasi berhasil.');
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
        $data =  Domain::find($id);

        if (!$data) {
          
            return redirect()->route('user.index')->with('error', 'Data tidak ditemukan.');
        }

        return view('back.users.edit_user', compact('data'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
            'nama_bengkel' => 'required',
            'alamat_bengkel' => 'required',
            'gmaps' => 'required',
            ],[
                'nama_bengkel.required' => 'Nama Bengkel',
                'alamat_bengkel.required' => 'Alamat Bengkel',
                'gmaps.required' => 'Link Maps Bengkel',
            ]
        );

        $data = [
            'nama_bengkel'=>$request->nama_bengkel,
            'alamat_bengkel'=>$request->alamat_bengkel,
            'gmaps'=>$request->gmaps,
        ];
        Domain::where('id', $id)->update($data);

        session()->flash('alert', 'success');
        session()->flash('message', 'Edit Data berhasil.');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Domain::find($id);

        if($data){
            $data->delete();
        }

    session()->flash('alert', 'success');
    session()->flash('message', 'Hapus Data berhasil.');
    return redirect()->route('user.index');
    }


    public function toggleStatus(Request $request, $id)
    {
        $user = User::find($id);

        if ($user) {
            $newStatus = $request->input('status');

            if ($newStatus == 1) {
                // Jika status ingin diubah menjadi aktif (1)
                $user->status = $newStatus;
                $user->activated_date = now();
                $user->expired_date = now()->addDays(30);
                $user->save();
            } 

                // Tambahkan logika untuk mengubah status menjadi tidak aktif (0)
            if ($user->status == 1 && now() > $user->expired_date) {
                $user->status = 0;
                $user->save();
            }

            session()->flash('alert', 'success');
            session()->flash('message', 'Update Status Berhasil.');
            return redirect()->route('user.index');
        }
    }


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

    public function ProfileCom(){
        $user = Auth::user();
        $domainId = optional($user->domain)->id;
    
        $profileDataBengkel = Domain::find($domainId);
    
        return view('back.users.profile_com', compact('user', 'domainId', 'profileDataBengkel'));
    }

 
    public function ProfileComStore(Request $request){
       
        $user = Auth::user();
        $domain = $user->domain;
    
        // Validasi input sesuai kebutuhan
    
        // Periksa apakah user memiliki domain
        if ($domain) {
            // Lakukan update langsung pada model Domain
            $domain->nama_bengkel = $request->input('nama_bengkel');
            $domain->alamat_bengkel = $request->input('alamat_bengkel');
            $domain->gmaps = $request->input('gmaps');
    
            if ($request->file('foto')) {
                $file = $request->file('foto');
                @unlink(public_path('image/profile_bengkel/' . $domain->foto));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('image/profile_bengkel'), $filename);
                $domain->foto = $filename;
            }
    
            $domain->save();
    
            session()->flash('alert', 'success');
            session()->flash('message', 'Update Status Berhasil.');
        } else {
            session()->flash('alert', 'danger');
            session()->flash('message', 'Data tidak ditemukan.');
        }
    
        return back();
    }
    
    public function DashboardUser(){
        // Memastikan user terotentikasi
        if (Auth::check()) {
            $authUserId = Auth::id();
    
            // Memastikan user memiliki properti 'domain' dan memuatnya
            $authUser = User::find($authUserId);
            if ($authUser != null && $authUser->domain != null) {
                $authUser->load('domain');
    
                // Kembalikan view dengan data domain
                return view('back.users.dashboard_user', compact('authUser'));
            } else {
                // Handle jika user tidak memiliki domain
                return redirect()->route('login')->with('error', 'Anda perlu login terlebih dahulu.');
            }
        } else {
            // Handle jika user tidak terotentikasi
            return redirect()->route('login')->with('error', 'Anda perlu login terlebih dahulu.');
        }
    }
    
    //tidak terpakai
    public function PosUser(){

        $domainId = Auth::user()->domain->id;

        $product = Item::where('domain_id', $domainId)->get();
        
        return view('back.users.pos_user', compact('product'));

    }
    
    
    
    public function PosBase(){

        $category = Category::all();
        $domainId = Auth::user()->domain->id;
        $products = Product::where('domain_id', $domainId)->get();
        
        return view('back.users.pos_base', compact('category','products'));
    }

    public function CosUser(){
        
        $domainId = Auth::user()->domain->id;

        $data = User::where('domain_id', $domainId)->get();

        return view('back.users.costumer_user', compact('data'));
    }
    
    public function ProfileBengkel(){


    }

    public function transaction(){
        return view('back.admin.transaksi');
    }

    public function whatsappadmin(){
        return view('back.admin.whatsapp_admin');
    }

}
