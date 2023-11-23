@extends('layouts.recipient')
@section('title', 'View')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                <h2 class="title">View</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="alert alert-primary">
                <h2 class="alert-heading mb-3">Subject: {{ $recipient->track_document->subject }}</h2>
                <h4 class="alert-heading">Sender: {{ $recipient->track_document->user->name }}</h4>
                <p>Recipients:</p>
                <ul>
                    @foreach($recipient->track_document->recipients->sortByDesc('status_date'); as $frecipient)
                        <li>
                            <div class="card mb-3 col-12 col-lg-6">
                                <div class="card-header">
                                    @if($frecipient->status->id == 1)
                                        <span class="badge text-bg-warning">{{ $frecipient->status->name }}</span>
                                    @elseif($frecipient->status->id == 2)
                                        <span class="badge text-bg-success">{{ $frecipient->status->name }}</span>
                                    @elseif($frecipient->status->id == 3)
                                        <span class="badge text-bg-danger">{{ $frecipient->status->name }}</span>
                                    @else
                                        <span class="badge">{{ $frecipient->status->name }}</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $frecipient->role->name }}</h5>
                                    <p class="card-text">{{ date("F j, Y, g:i a", strtotime($frecipient->status_date)) }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <hr />
                <p>Description: {{ $recipient->track_document->description }}</p>
                <p>Prioritization: {{ $recipient->track_document->prioritization }}</p>
                <p>Document Created Date: {{ date("F j, Y", strtotime($recipient->track_document->document_created_date)) }}</p>
                <p>Classification: {{ $recipient->track_document->classification }}</p>
                <p>Reference: {{ $recipient->track_document->reference }}</p>
                <p>Attachment: <div><img src="{{ url($recipient->track_document->attachment) }}" alt="attachment" width="500"></div></p>
                <p>Attachment Description: {{ $recipient->track_document->attachment_description }}</p> 
                <div class="d-flex align-items-center justify-content-end">
                    <form id="statusForm1" action="{{ route('recipient.change-recipient-status.track', $recipient->track_document->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="newStatus" value="1">
                        <button type="submit" class="btn btn-warning {{ $recipient->status->id !== 1 ? '' : 'disabled' }}">Pending</button>
                    </form>

                    <form id="statusForm2" action="{{ route('recipient.change-recipient-status.track', $recipient->track_document->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="newStatus" value="2">
                        <button type="submit" class="ms-2 btn btn-success {{ $recipient->status->id !== 2 ? '' : 'disabled' }}">Successful</button>
                    </form>

                    <form id="statusForm3" action="{{ route('recipient.change-recipient-status.track', $recipient->track_document->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="newStatus" value="3">
                        <button type="submit" class="ms-2 btn btn-danger {{ $recipient->status->id !== 3 ? '' : 'disabled' }}">Failed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
