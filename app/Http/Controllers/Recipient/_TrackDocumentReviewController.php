<?php

namespace App\Http\Controllers\Recipient;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;
use App\Models\TrackDocument;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class _TrackDocumentReviewController extends Controller
{
    public function index(){
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $recipients = Recipient::where('role_id', $user_role_id)->get();

        return view('recipient.track-document-reviews', compact('recipients'));
    }
    public function search(Request $request){
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $search = $request->input('search');
    
        $recipients = Recipient::where('role_id', $user_role_id)
            ->whereHas('track_document', function ($query) use ($search) {
                $query->where('subject', 'like', '%' . $search . '%');
            })
            ->get();

        return view('recipient.track-document-reviews', compact('recipients'));
    }
    public function view($id){
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $recipient = Recipient::where('role_id', $user_role_id)
        ->where('track_document_id', $id)
        ->first();

        if (!$recipient) {
            return abort(404);
        }

        return view('recipient.track-document-reviews-view', compact('recipient'));
    }

    public function changeRecipientStatus($id, Request $request){
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $recipient = Recipient::where('role_id', $user_role_id)
            ->where('track_document_id', $id)
            ->first();
        
        if (!$recipient) {
            return abort(404);
        }
    
        $newStatus = $request->input('newStatus');
        $recipient->status_id = $newStatus;
        $recipient->status_date = now();
        $recipient->save();
    
        return view('recipient.track-document-reviews-view', compact('recipient'));
    }

    public function qrScanner(){
        return view('recipient.track-document-reviews-qr-scanner');
    }

    public function qrScannerResult(Request $request) {
        $result = $request->result;
        $user_role_id = auth()->guard('recipient')->user()->role->id;
        $recipient = Recipient::where('role_id', $user_role_id)
            ->whereHas('track_document', function ($query) use ($result) {
                $query->where('qr_code', $result);
            })
            ->first();

            if ($recipient) {
                // Return a JSON response with the result
                return response()->json(['trackDocument' => $recipient->track_document]);
            } else {
                // Return a JSON response indicating that no recipient was found
                return response()->json(['trackDocument' => 'No recipient found'], 404);
            }
    }
}
