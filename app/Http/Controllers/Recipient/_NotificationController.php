<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;

class _NotificationController extends Controller
{
    public function index(){
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notificationss = Notification::where('recipient_id', $user_role_id)->get();
        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();

        // dd($notifications);
        return view('recipient.notifications', compact('notificationss', 'notifications'));
    }

    public function status(Request $request, $id){
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notification = Notification::where('recipient_id', $user_role_id)->find($id);
        $notification->read_status = $request->read_status;
        $notification->save();

        return redirect()->route('recipient.notifications.index')->with('success', 'Notification status changed successfully');
    }

    public function notificationCount(){
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();

        dd($notifications);
        // dd($notifications);
        return view('layouts.recipient', compact('notifications'));
    }
}
