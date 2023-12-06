<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class _SupportController extends Controller
{
    public function index(){
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();

        return view('recipient.support', compact('notifications'));
    }
}
