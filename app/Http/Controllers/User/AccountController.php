<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function changePassword(){
        return view('user.change-password');
    }

    public function editProfile(){
        return view('user.edit-profile');
    }

    public function updateProfile(Request $request){
        $user = User::find(auth()->guard('normal')->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect('/edit-profile')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('normal')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('account.change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect('/change-password')->with('success', 'Password changed successfully');
    }
}
