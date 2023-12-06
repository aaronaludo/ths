<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use App\Models\RequestDocument;
use Illuminate\Http\Request;
use App\Models\Notification;

class _ReportController extends Controller
{
    public function index(Request $request){
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();
        
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $pendingTrackDocuments =  Recipient::where('role_id', $user_role_id)->where('status_id', 1)->count();
        $successTrackDocuments =  Recipient::where('role_id', $user_role_id)->where('status_id', 2)->count();
        $failedTrackDocuments =  Recipient::where('role_id', $user_role_id)->where('status_id', 3)->count();
          
        $pendingRequestDocuments = 0;
        $successRequestDocuments = 0;
        $failedRequestDocuments = 0;

        if ($user_role_id === 10) {
            $pendingRequestDocuments = RequestDocument::where('status_id', 1)->count();
            $successRequestDocuments = RequestDocument::where('status_id', 2)->count();
            $failedRequestDocuments = RequestDocument::where('status_id', 3)->count();
        }

        // dd($pendingTrackDocuments, $successTrackDocuments, $failedTrackDocuments, $pendingRequestDocuments, $successRequestDocuments, $failedRequestDocuments);

        return view('recipient.reports', compact('notifications', 'pendingRequestDocuments', 'successRequestDocuments', 'failedRequestDocuments', 'pendingTrackDocuments', 'successTrackDocuments', 'failedTrackDocuments'));
    }
}
