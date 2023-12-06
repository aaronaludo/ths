<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\RequestDocument;
use Illuminate\Http\Request;
use App\Models\Notification;

class _DashboardController extends Controller
{
    public function index(){
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();

        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $totalTrackDocuments = Recipient::where('role_id', $user_role_id)->count();
        $pendingTrackDocuments =  Recipient::where('role_id', $user_role_id)->where('status_id', 1)->count();
        $successTrackDocuments =  Recipient::where('role_id', $user_role_id)->where('status_id', 2)->count();
        $failedTrackDocuments =  Recipient::where('role_id', $user_role_id)->where('status_id', 3)->count();
        $shortTrackDocuments = Recipient::where('role_id', $user_role_id)->take(5)->get();
        
        $totalRequestDocuments = 0;    
        $pendingRequestDocuments = 0;
        $successRequestDocuments = 0;
        $failedRequestDocuments = 0;
        $shortRequestDocuments = [];

        if ($user_role_id === 10) {
            $totalRequestDocuments = RequestDocument::all()->count();
            $pendingRequestDocuments = RequestDocument::where('status_id', 1)->count();
            $successRequestDocuments = RequestDocument::where('status_id', 2)->count();
            $failedRequestDocuments = RequestDocument::where('status_id', 3)->count();
            $shortRequestDocuments = RequestDocument::take(5)->get();
        }

        return view('recipient.dashboard', compact('totalTrackDocuments', 'pendingTrackDocuments', 'successTrackDocuments', 'failedTrackDocuments', 'shortTrackDocuments', 'totalRequestDocuments',
            'pendingRequestDocuments', 'successRequestDocuments', 'failedRequestDocuments', 'shortRequestDocuments', 'notifications'));
    }
}
