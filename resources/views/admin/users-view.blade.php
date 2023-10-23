@extends('layouts.admin')

@section('title', 'View User')

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
                <h4 class="alert-heading mb-4">Name: {{ $user->name }}</h4>
                <h4 class="alert-heading mb-4">Email: {{ $user->email }}</h4>
                <h4 class="alert-heading">Password: {{ $user->password }}</h4>
                <div class="d-flex justify-content-end">
                    <div class="action-button">
                        <a href="{{ route('admin.users.edit', $user->id) }}" title="Edit">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                    </div>
                    <div class="action-button">
                        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#delete-modal-{{ $user->id }}" title="Delete">
                            <i class="fa-solid fa-trash color-red"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete-modal-{{ $user->id }}" tabindex="-1" aria-labelledby="delete-modal-{{ $user->id }}-label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delete-modal-{{ $user->id }}-label">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this {{ $user->id }} document?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
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
@endsection
