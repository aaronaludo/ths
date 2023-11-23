<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        if (Auth::guard('normal')->check()) {
            return redirect('/dashboard');
        }

        return view('user.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('normal')->attempt($credentials)) {
            $user = Auth::guard('normal')->user();
            
            if ($user->role_id === 1 && $user->archive === 0) {
                return redirect()->intended('/dashboard');
            }
    
            Auth::guard('normal')->logout();
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::guard('normal')->logout();
        return redirect('/login');
    }
}
