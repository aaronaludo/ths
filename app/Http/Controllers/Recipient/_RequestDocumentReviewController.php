<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use App\Models\RequestDocument;
use Illuminate\Http\Request;
use App\Models\Notification;

class _RequestDocumentReviewController extends Controller
{
    public function index() {
        $user_role_id = auth()->guard('recipient')->user()->role->id;

        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();

        $requestDocuments = [];
    
        if ($user_role_id === 10) {
            $requestDocuments = RequestDocument::where('archive', 0)->get();
        }
    
        return view('recipient.request-document-reviews', compact('requestDocuments', 'notifications'));
    }

    public function search(Request $request){
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $search = $request->search;

        $requestDocuments = [];
    
        if ($user_role_id === 10) {
            $requestDocuments = RequestDocument::where('type_of_document', 'like', '%' . $search . '%')->get();
        }

        return view('recipient.request-document-reviews', compact('requestDocuments'));
    }

    public function view($id){
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $notifications = Notification::where('recipient_id', $user_role_id)->where('read_status', 0)->count();
        $requestDocument = null;
    
        if ($user_role_id === 10) {
            $requestDocument = RequestDocument::find($id);
        }
        
        if (!$requestDocument) {
            return abort(404);
        }

        return view('recipient.request-document-reviews-view', compact('requestDocument', 'notifications'));
    }
    public function changeRequestDocumentStatus($id, Request $request){
        $user_role_id = auth()->guard('recipient')->user()->role->id;
    
        $requestDocument = null;
    
        if ($user_role_id === 10) {
            $requestDocument = RequestDocument::find($id);
        }

        if (!$requestDocument) {
            return abort(404);
        }

        $requestDocument->status_id = $request->newStatus;
        $requestDocument->save();

        // dd($requestDocument->status->id);
        return view('recipient.request-document-reviews-view', compact('requestDocument'));
    }
}
