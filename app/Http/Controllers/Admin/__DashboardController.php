<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class __DashboardController extends Controller
{
    public function index(){
        $totalUsers = User::where('role_id', 1)->count();
        $shortUsers = User::where('role_id', 1)->take(5)->get();

        $totalAdmins = User::where('role_id', 2)->count();
        $shortAdmins = User::where('role_id', 2)->take(5)->get();

        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $totalRecipients = User::whereIn('role_id', $roles)->count();
        $shortRecipients = User::whereIn('role_id', $roles)->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'shortUsers', 'totalAdmins', 'shortAdmins', 'totalRecipients', 'shortRecipients'));
    }
}
