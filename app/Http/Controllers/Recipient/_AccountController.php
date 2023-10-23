<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class _AccountController extends Controller
{
    public function editProfile(){
        return view('recipient.edit-profile');
    }

    public function changePassword(){
        return view('recipient.change-password');
    }

    public function updateProfile(Request $request){
        $user = User::find(auth()->guard('recipient')->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/recipient/edit-profile')->with('success', 'Profile updated successfully');
    }
    
    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('recipient.account.change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('recipient')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('recipient.account.change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/recipient/change-password')->with('success', 'Password changed successfully');
    }

}
