@extends('layouts.user')
@section('title', 'View Request')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div>
                <h2 class="title">View Request</h2>
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
                <div class="d-flex justify-content-end">
                    <div class="action-button">
                    <a href="{{ route('request-documents.edit', $requestDocument->id) }}" title="Edit"
                        ><i class="fa-solid fa-pencil"></i
                    ></a>
                    </div>
                    <div class="action-button">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $requestDocument->id }}" title="Delete">
                            <i class="fa-solid fa-trash color-red"></i>
                        </button>
                    </div>
                </div>
                </div>
                <div class="modal fade" id="delete-modal-{{ $requestDocument->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $requestDocument->id }}-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="delete-modal-{{ $requestDocument->id }}-label">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this {{ $requestDocument->id }} document?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form method="POST" action="{{ route('request-documents.destroy', $requestDocument->id) }}">
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
