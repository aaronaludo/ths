<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TrackDocument;
use App\Models\Recipient;
use App\Models\Role;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TrackDocumentController extends Controller
{
    public function index(){
        $userId = auth()->guard('normal')->user()->id;
        $trackDocuments = TrackDocument::where('user_id', $userId)->get();
        return view('user.track-documents', compact('trackDocuments'));
    }

    public function search(Request $request){
        $userId = auth()->guard('normal')->user()->id;
        $search = $request->input('search');
    
        $trackDocuments = TrackDocument::where('user_id', $userId)
            ->where('subject', 'like', '%' . $search . '%')
            ->get();
    
        return view('user.track-documents', compact('trackDocuments'));
    }

    public function view($id) {
        $userId = auth()->guard('normal')->user()->id;
    
        $trackDocument = TrackDocument::where('user_id', $userId)
            ->find($id);
    
        if (!$trackDocument) {
            return abort(404);
        }
    
        $qrcode = QrCode::size(300)->generate($trackDocument->qr_code);
        $data = compact('trackDocument', 'qrcode');
    
        return view('user.track-documents-view', $data);
    }

    public function composeEdit($id){
        $userId = auth()->guard('normal')->user()->id;
    
        $trackDocument = TrackDocument::where('user_id', $userId)
            ->find($id);
    
        if (!$trackDocument) {
            return abort(404);
        }
    
        $roles = Role::all();
    
        $selectedRecipients = $trackDocument->recipients->pluck('role_id')->toArray();
    
        return view('user.track-documents-edit', compact('trackDocument', 'roles', 'selectedRecipients'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'description' => 'required',
            'prioritization' => 'required',
            'classification' => 'required',
            'reference' => 'required',
            'attachment_description' => 'required'
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('track-documents.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }
    
        $userId = auth()->guard('normal')->user()->id;
    
        $trackDocument = TrackDocument::where('user_id', $userId)
            ->find($id);
    
        if (!$trackDocument) {
            return abort(404);
        }
    
        $trackDocument->subject = $request->input('subject');
        $trackDocument->description = $request->input('description');
        $trackDocument->prioritization = $request->input('prioritization');
        $trackDocument->classification = $request->input('classification');
        $trackDocument->reference = $request->input('reference');
        $trackDocument->attachment_description = $request->input('attachment_description');
    
        $trackDocument->save();
    
        return redirect()->route('track-documents.index')->with('success', 'Document updated successfully');
    }    

    public function composeIndex(){
        return view('user.track-documents-compose');
    }

    public function composeStore(Request $request){
        $validator = Validator::make($request->all(), [
            'recipients' => 'required',
            'subject' => 'required',
            'description' => 'required',
            'prioritization' => 'required',
            'document_created_date' => 'required',
            'classification' => 'required',
            'reference' => 'required',
            'attachment' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            'attachment_description' => 'required',
        ], [
            'attachment.required' => 'The attachment is required.',
            'attachment.mimes' => 'The attachment must be a JPEG, PNG, or PDF.',
            'attachment.max' => 'The attachment may not be greater than 2MB.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('track-documents.compose')
                ->withErrors($validator)
                ->withInput();
        }
    
        DB::transaction(function () use ($request) {
            $userId = auth()->guard('normal')->user()->id; 
    
            $path = $request->file('attachment')->store('public');
            $url = Storage::url($path);
    
            $trackDocument = new TrackDocument;
            $trackDocument->user_id = $userId;
            $trackDocument->qr_code = $userId . '_' . time();
            $trackDocument->subject = $request->subject;
            $trackDocument->description = $request->description;
            $trackDocument->prioritization = $request->prioritization;
            $trackDocument->document_created_date = $request->document_created_date;
            $trackDocument->classification = $request->classification;
            $trackDocument->reference = $request->reference;
            $trackDocument->attachment = $url;
            $trackDocument->archive = 0;
            $trackDocument->attachment_description = $request->attachment_description;
            $trackDocument->save();
    
            foreach ($request->recipients as $recipient) {
                $recipients = new Recipient;
                $recipients->track_document_id = $trackDocument->id;
                $recipients->role_id = $recipient;
                $recipients->status_id = 1;
                $recipients->status_date = now();
                $recipients->save();

                $notification = new Notification();
                $notification->recipient_id = $recipients->role_id;
                $notification->message = "You received a track documents";
                $notification->read_status = 0;
                $notification->save();
            }
        });
    
        return redirect()->route('track-documents.compose')->with('success', 'Document created successfully');
    }

    public function destroy($id) {
        $userId = auth()->guard('normal')->user()->id;
        
        $document = TrackDocument::where('user_id', $userId)
            ->find($id);
    
        if (!$document) {
            return abort(404);
        }
    
        $document->recipients()->delete();
        
        $document->delete();
    
        return redirect()->route('track-documents.index')->with('success', 'Document deleted successfully');
    }

    public function archive($id){
        $userId = auth()->guard('normal')->user()->id;
        
        $document = TrackDocument::where('user_id', $userId)
            ->find($id);
        $success = '';

        if(!$document){
            return abort(404);
        }
 
        if($document->archive == 1){
            $document->archive = 0;
            $success = 'unarchive';
        }else if($document->archive == 0){
            $document->archive = 1;
            $success = 'archive';
        };

        $document->save();

       return redirect()->route('track-documents.index')->with('success', 'Document '.$success.' successfully');
    }

}
