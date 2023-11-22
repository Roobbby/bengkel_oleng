<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Domain;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function Profile(){

        if (!Auth::check()) {
            
            session()->flash('alert', 'error');
            session()->flash('message', 'Silakan login terlebih dahulu.');
            return redirect('/login');
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('back.profile', compact('profileData'));
    }

    public function ProfilCom(){
        
        $id = Auth::user()->id;
        $profilecom = Domain::find($id);
        return view('back.users.profile_com', compact('profilecom'));
    }
    
    public function ProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->sapaan = $request->sapaan; 
        $data->panggilan = $request->panggilan;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->telp = $request->telp;
        $data->gender = $request->gender;
        

        if ($request->file('foto_profile')) {
            $file = $request->file('foto_profile');
            @unlink(public_path('image/profile/'.$data->foto_profile));
            $filename = date('YmdHi').$file->getClientOriginalName(); 
            $file->move(public_path('image/profile'),$filename);
            $data['foto_profile'] = $filename;
        }
        
        $data->save();

        session()->flash('alert', 'success');
        session()->flash('message', 'Update Data berhasil.');
        return redirect()->back();
    }

    public function ChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('back.change_password',compact('profileData'));

    }

    public function UpdatePassword(Request $request){
        try {
            // Validation
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
    
            // Match Old Password
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->with('alert', 'error')->with('message', 'Password Lama Salah.');
            }
    
            // Update New Password
            $updateResult = User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);
    
            if ($updateResult) {
                return back()->with('alert', 'success')->with('message', 'Update Password Berhasil.');
            } else {
                throw new \Exception('Gagal mengupdate password.');
            }
        } catch (\Exception $e) {
            // Handle the exception, you can log it or return a specific error message
            return back()->with('alert', 'error')->with('message', $e->getMessage());
        }
    }    

    public function checkOldPassword(Request $request) {
        $oldPassword = $request->input('old_password');
        $user = Auth::user();
    
        if (Hash::check($oldPassword, $user->password)) {
            return response()->json(['valid' => true]);
        } else {
            return response()->json(['valid' => false]);
        }
    }

    public function checksWhatsApp(Request $request) {
        $telp = $request->input('telp');

        $telp = User::where('telp', $telp)->first();

        if ($telp) {
          
            return response()->json(['available' => false]);
        } else {
           
            return response()->json(['available' => true]);
        }
    }

    public function checksEmail(Request $request){
        $email = $request->input('email');

        $email = User::where('email', $email)->first();

        if ($email) {
           
            return response()->json(['available' => false]);
        } else {
      
            return response()->json(['available' => true]);
        }
    }
}
