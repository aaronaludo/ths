@extends('layouts.recipient')
@section('title', 'Track Document Reviews')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Track Document Reviews</h1></div>
                <div class="d-flex align-items-center"><a class="btn btn-primary" href="{{ route('recipient.track-document-reviews.qr-scanner') }}"><i class="fa-solid fa-qrcode"></i>&nbsp;&nbsp;&nbsp;QR Scanner</a></div>
            </div>
            <div class="col-lg-12 mb-20">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-10">
                            <form action="{{ route('recipient.track-document-reviews.search') }}" method="GET">
                                <div class="input-group mb-3 mb-lg-0">
                                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search by Subject" />
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <th>ID</th>
                                        <th>Subject</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </thead>
                                    <tbody>
                                        {{-- recipients --}}
                                        @foreach ($recipients as $recipient)
                                            <tr>
                                                <td>{{ $recipient->track_document->id }}</td>
                                                <td>{{ $recipient->track_document->subject }}</td>
                                                <td>{{ $recipient->status->name }}</td>
                                                <td>{{ date("F j, Y, g:i a", strtotime($recipient->track_document->created_at)) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="action-button"><a href="{{ route('recipient.track-document-reviews.view', $recipient->track_document->id) }}" title="View"><i class="fa-solid fa-eye"></i></a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection