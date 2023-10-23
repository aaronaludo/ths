<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class _AuthController extends Controller
{
    public function index(){
        if (Auth::guard('recipient')->check()) {
            return redirect('/recipient/dashboard');
        }

        return view('recipient.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('recipient')->attempt($credentials)) {
            $user = Auth::guard('recipient')->user();
            
            if ($user->role_id >= 3 && $user->role_id <= 19) {
                return redirect()->intended('/recipient/dashboard');
            }
    
            Auth::guard('recipient')->logout();
            return redirect()->route('recipient.login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('recipient.login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('recipient')->logout();
        return redirect('/recipient/login');
    }
}
