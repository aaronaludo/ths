@extends('layouts.user')
@section('title', 'Edit Track')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Edit</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('track-documents.update', ['id' => $trackDocument->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div class="mb-3 row">
                                    <label for="Sender" class="col-sm-12 col-lg-2 col-form-label">Sender: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <span class="fw-bold">{{ $trackDocument->user->name }}</span>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="subject" class="col-sm-12 col-lg-2 col-form-label">Subject: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="subject" name="subject" value="{{ $trackDocument->subject }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-12 col-lg-2 col-form-label">Description: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ $trackDocument->description }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="prioritization" class="col-sm-12 col-lg-2 col-form-label">Prioritization: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <select name="prioritization" id="prioritization" class="form-select form-control">
                                            <option disabled>Select Option</option>
                                            <option value="Usual" {{ $trackDocument->prioritization == 'Usual' ? 'selected' : '' }}>Usual</option>
                                            <option value="Urgent" {{ $trackDocument->prioritization == 'Urgent' ? 'selected' : '' }}>Urgent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="classification" class="col-sm-12 col-lg-2 col-form-label">Classification: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <select name="classification" id="classification" class="form-select form-control">
                                            <option disabled>Select Option</option>
                                            <option value="Indorsement/Transmittal" {{ $trackDocument->classification == 'Indorsement/Transmittal' ? 'selected' : '' }}>Indorsement/Transmittal</option>
                                            <option value="Letter" {{ $trackDocument->classification == 'Letter' ? 'selected' : '' }}>Letter</option>
                                            <option value="Memorandum" {{ $trackDocument->classification == 'Memorandum' ? 'selected' : '' }}>Memorandum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="reference" class="col-sm-12 col-lg-2 col-form-label">Reference: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="reference" name="reference" value="{{ $trackDocument->reference }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="attachment_description" class="col-sm-12 col-lg-2 col-form-label">Attachment Description:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="attachment_description" name="attachment_description" value="{{ $trackDocument->attachment_description ?? '' }}"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection