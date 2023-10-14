<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    public function Profile(){

        if (!Auth::check()) {
        
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('back.profile', compact('profileData'));
    }
    
    public function ProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->telp = $request->telp;
        

        if ($request->file('foto')) {
            $file = $request->file('foto');
            @unlink(public_path('image/profile/'.$data->foto));
            $filename = date('YmdHi').$file->getClientOriginalName(); //23232.aaryian.png
            $file->move(public_path('image/profile'),$filename);
            $data['foto'] = $filename;
        }
        
        $data->save();

        $notification = array(
            'message' => ' Profile Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('back.change_password',compact('profileData'));

    }

    public function UpdatePassword(Request $request){
        
        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        // Match Old Password
        if (!Hash::check($request->old_password, auth::user()->password )) {

            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        // Update New Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }
}
