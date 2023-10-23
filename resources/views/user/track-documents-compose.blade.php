@extends('layouts.user')
@section('title', 'Compose')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Compose</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('track-documents.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
                                        <input type="hidden" name="user_id" value="{{ auth()->guard('normal')->user()->id }}">
                                        <span class="fw-bold">{{ auth()->guard('normal')->user()->name }}</span>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-12 col-lg-2 col-form-label">Recipients: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <div class="row">
                                            @php
                                                $recipients = [
                                                    'office_principal' => ['name' => 'Office of the Principal', 'number' => 3],
                                                    'accounting' => ['name' => 'Accounting Office', 'number' => 4],
                                                    'supply' => ['name' => 'Supply Office', 'number' => 5],
                                                    'library' => ['name' => 'Library', 'number' => 6],
                                                    'bid_awards' => ['name' => 'Bid and Awards Committee', 'number' => 7],
                                                    'physical_facilities' => ['name' => 'Physical Facilities', 'number' => 8],
                                                    'guidance' => ['name' => 'Guidance Office', 'number' => 9],
                                                    'registrar' => ['name' => 'Registrar', 'number' => 10],
                                                    'senior_high' => ['name' => 'Senior High Coordinator', 'number' => 11],
                                                    'subject_area_1' => ['name' => 'Subject Area Coordinator 1', 'number' => 12],
                                                    'subject_area_2' => ['name' => 'Subject Area Coordinator 2', 'number' => 13],
                                                    'subject_area_3' => ['name' => 'Subject Area Coordinator 3', 'number' => 14],
                                                    'subject_area_4' => ['name' => 'Subject Area Coordinator 4', 'number' => 15],
                                                    'subject_area_5' => ['name' => 'Subject Area Coordinator 5', 'number' => 16],
                                                    'subject_area_6' => ['name' => 'Subject Area Coordinator 6', 'number' => 17],
                                                    'subject_area_7' => ['name' => 'Subject Area Coordinator 7', 'number' => 18],
                                                    'subject_area_8' => ['name' => 'Subject Area Coordinator 8', 'number' => 19],
                                                ];
                                            @endphp
                                            @foreach ($recipients as $name => $data)
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="{{ $name }}" name="recipients[]" value="{{ $data['number'] }}">
                                                        <label class="form-check-label" for="{{ $name }}">{{ $data['name'] }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="subject" class="col-sm-12 col-lg-2 col-form-label">Subject: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="subject" name="subject"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="description" class="col-sm-12 col-lg-2 col-form-label">Description: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="prioritization" class="col-sm-12 col-lg-2 col-form-label">Prioritization: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <select name="prioritization" id="prioritization" class="form-select form-control">
                                            <option selected disabled>Select Option</option>
                                            <option value="Usual">Usual</option>
                                            <option value="Urgent">Urgent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="document_created_date" class="col-sm-12 col-lg-2 col-form-label">Document Created Date: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="date" class="form-control" id="document_created_date" name="document_created_date"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="classification" class="col-sm-12 col-lg-2 col-form-label">Classification: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <select name="classification" id="classification" class="form-select form-control">
                                            <option selected>Select Option</option>
                                            <option value="Indorsement/Transmittal">Indorsement/Transmittal</option>
                                            <option value="Letter">Letter</option>
                                            <option value="Memorandum">Memorandum</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="reference" class="col-sm-12 col-lg-2 col-form-label">Reference: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="reference" name="reference"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="attachment" class="col-sm-12 col-lg-2 col-form-label">Add Attachment: (optional)</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="file" class="form-control" id="attachment" name="attachment"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="attachment_description" class="col-sm-12 col-lg-2 col-form-label">Attachment Description:</label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="attachment_description" name="attachment_description"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <button class="btn btn-primary" type="submit">Generate QR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection