<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TrackDocument;
use App\Models\RequestDocument;

class DashboardController extends Controller
{
    public function index(){
        $totalTrackDocuments = TrackDocument::where('user_id', auth()->guard('normal')->user()->id)->count();
        $checkTrackDocuments = TrackDocument::where('user_id', auth()->guard('normal')->user()->id)->get();
        $pendingTrackDocuments = 0;
        $successTrackDocuments = 0;
        $failedTrackDocuments = 0;
        $shortTrackDocuments = TrackDocument::where('user_id', auth()->guard('normal')->user()->id)->latest()->take(5)->get();

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

        $totalRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->count();
        $pendingRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->where('status_id', 1)->count();
        $successRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->where('status_id', 2)->count();
        $failedRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->where('status_id', 3)->count();
        $shortRequestDocuments = RequestDocument::where('user_id', auth()->guard('normal')->user()->id)->latest()->take(5)->get();

        return view('user.dashboard', compact(
            'totalTrackDocuments', 'pendingTrackDocuments', 'successTrackDocuments', 'failedTrackDocuments', 'shortTrackDocuments',
            'totalRequestDocuments', 'pendingRequestDocuments', 'successRequestDocuments', 'failedRequestDocuments', 'shortRequestDocuments'
        ));
    }
}
