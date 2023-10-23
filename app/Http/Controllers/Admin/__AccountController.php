<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class __AccountController extends Controller
{
    public function editProfile(){
        return view('admin.edit-profile');
    }

    public function changePassword(){
        return view('admin.change-password');
    }

    public function updateProfile(Request $request){
        $user = User::find(auth()->guard('admin')->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/admin/edit-profile')->with('success', 'Profile updated successfully');
    }
    
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.account.change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('admin')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('admin.account.change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/admin/change-password')->with('success', 'Password changed successfully');
    }

}
