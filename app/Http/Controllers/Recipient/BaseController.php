<?php

namespace App\Http\Controllers\Recipient;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class BaseController extends Controller
{
    public function notificationCount(){
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();

        return view('layouts.recipient', compact('notifications'));
    }
}
