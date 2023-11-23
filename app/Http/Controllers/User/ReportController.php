<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestDocument;
use App\Models\TrackDocument;

class ReportController extends Controller
{
    public function index()
    {
        $checkTrackDocuments = TrackDocument::where('user_id', auth()->guard('normal')->user()->id)->get();
        $pendingTrackDocuments = 0;
        $successTrackDocuments = 0;
        $failedTrackDocuments = 0;

        foreach ($checkTrackDocuments as $document) {
            foreach ($document->recipients as $recipient) {
                if ($recipient->status->id === 1) {
                    $pendingTrackDocuments++;
                } elseif ($recipient->status->id === 2) {
                    $successTrackDocuments++;
                } elseif ($recipient->status->id === 3) {
                    $failedTrackDocuments++;
                }
            }
        }

        $pendingRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->where('status_id', 1)->count();
        $successRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->where('status_id', 2)->count();
        $failedRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->where('status_id', 3)->count();

        // dd($successRequestDocuments, $pendingRequestDocuments, $failedRequestDocuments);

        return view('user.reports', compact('pendingRequestDocuments', 'successRequestDocuments', 'failedRequestDocuments', 'pendingTrackDocuments', 'successTrackDocuments', 'failedTrackDocuments'));
    }
}
