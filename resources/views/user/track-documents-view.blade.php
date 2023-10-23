@extends('layouts.user')
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
                <h2 class="alert-heading mb-3">Subject: {{ $trackDocument->subject }}</h2>
                <h4 class="alert-heading">Sender: {{ $trackDocument->user->name }}</h4>
                <p>Recipients:</p>
                <ul>
                    @foreach($trackDocument->recipients as $recipient)
                        <li>
                            <div class="card mb-3 col-12 col-lg-6">
                                <div class="card-header">
                                    @if($recipient->status->id == 1)
                                        <span class="badge text-bg-warning">{{ $recipient->status->name }}</span>
                                    @elseif($recipient->status->id == 2)
                                        <span class="badge text-bg-success">{{ $recipient->status->name }}</span>
                                    @elseif($recipient->status->id == 3)
                                        <span class="badge text-bg-danger">{{ $recipient->status->name }}</span>
                                    @else
                                        <span class="badge">{{ $recipient->status->name }}</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">{{ $recipient->role->name }}</h5>
                                    <p class="card-text">{{ date("F j, Y, g:i a", strtotime($recipient->status_date)) }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <hr />
                <p>Description: {{ $trackDocument->description }}</p>
                <p>Prioritization: {{ $trackDocument->prioritization }}</p>
                <p>Document Created Date: {{ date("F j, Y", strtotime($trackDocument->document_created_date)) }}</p>
                <p>Classification: {{ $trackDocument->classification }}</p>
                <p>Reference: {{ $trackDocument->reference }}</p>
                <p>Attachment: <div><img src="{{ url($trackDocument->attachment) }}" alt="attachment" width="500"></div></p>
                <p>Attachment Description: {{ $trackDocument->attachment_description }}</p>
                <div class="mt-5 mb-3">
                    {{ $qrcode }}
                </div>
                <a href="data:image/svg+xml;base64,<?php echo base64_encode($qrcode); ?>" class="btn btn-success btn-lg" download="qrcode.svg">
                    <i class="fas fa-download"></i> Download QR
                </a>
                <div class="d-flex justify-content-end">
                    <div class="action-button">
                    <a href="{{ route('track-documents.edit', $trackDocument->id) }}" title="Edit"
                        ><i class="fa-solid fa-pencil"></i
                    ></a>
                    </div>
                    <div class="action-button">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $trackDocument->id }}" title="Delete">
                            <i class="fa-solid fa-trash color-red"></i>
                        </button>
                    </div>
                </div>
                </div>
                <div class="modal fade" id="delete-modal-{{ $trackDocument->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $trackDocument->id }}-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-modal-{{ $trackDocument->id }}-label">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this {{ $trackDocument->id }} document?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form method="POST" action="{{ route('track-documents.destroy', $trackDocument->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection