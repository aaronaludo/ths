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
                <h2 class="alert-heading mb-3">Type of Document: {{ $requestDocument->type_of_document }}</h2>
                <h4 class="alert-heading">Sender: {{ $requestDocument->user->name }}</h4>
                <p>Recipients:</p>
                    <ul>
                        <li>
                        <div class="card mb-3 col-12 col-lg-6">
                            <div class="card-header">
                                @if($requestDocument->status->id == 1)
                                    <span class="badge text-bg-warning">{{ $requestDocument->status->name }}</span>
                                @elseif($requestDocument->status->id == 2)
                                    <span class="badge text-bg-success">{{ $requestDocument->status->name }}</span>
                                @elseif($requestDocument->status->id == 3)
                                    <span class="badge text-bg-danger">{{ $requestDocument->status->name }}</span>
                                @else
                                    <span class="badge">{{ $requestDocument->status->name }}</span>
                                @endif
                            </div>
                            <div class="card-body">
                            <h5 class="card-title fw-bold">Registrar</h5>
                            <p class="card-text">{{ date("F j, Y, g:i a", strtotime($requestDocument->status_date)) }}</p>
                        </div>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center justify-content-end">
                        <form id="statusForm1" action="{{ route('recipient.change-recipient-status.request', $requestDocument->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="newStatus" value="1">
                            <button type="submit" class="btn btn-warning {{ $requestDocument->status->id !== 1 ? '' : 'disabled' }}">Pending</button>
                        </form>
    
                        <form id="statusForm2" action="{{ route('recipient.change-recipient-status.request', $requestDocument->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="newStatus" value="2">
                            <button type="submit" class="ms-2 btn btn-success {{ $requestDocument->status->id !== 2 ? '' : 'disabled' }}">Successful</button>
                        </form>
    
                        <form id="statusForm3" action="{{ route('recipient.change-recipient-status.request', $requestDocument->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="newStatus" value="3">
                            <button type="submit" class="ms-2 btn btn-danger {{ $requestDocument->status->id !== 3 ? '' : 'disabled' }}">Failed</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
