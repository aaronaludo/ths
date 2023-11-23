<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class __ReportController extends Controller
{
    public function index(){
        $totalUsers = User::where('role_id', 1)->count();
        $totalAdmins = User::where('role_id', 2)->count();
        $roles = [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19];
        $totalRecipients = User::whereIn('role_id', $roles)->count();

        return view('admin.reports', compact('totalUsers', 'totalAdmins', 'totalRecipients'));
    }
}
