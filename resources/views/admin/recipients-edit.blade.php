@extends('layouts.admin')
@section('title', 'Edit Recipient')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">Edit Recipient</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="box">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="{{ route('admin.recipients.update', ['id' => $user->id]) }}" method="POST">
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
                                    <label for="name" class="col-sm-12 col-lg-2 col-form-label">Name: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"/>
                                    </div>
                                </div>
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
                                <div class="mb-3 row">
                                    <label for="role" class="col-sm-12 col-lg-2 col-form-label">Role: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <select name="role" id="role" class="form-select form-control">
                                            @foreach ($recipients as $name => $data)
                                                <option value="{{ $data['number'] }}" {{ $user->role_id === $data['number'] ? 'selected' : '' }}>{{ $data['name'] }}</option>
                                            @endforeach
                                            <option value="4">Accounting Office</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-12 col-lg-2 col-form-label">Email: <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"/>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-sm-12 col-lg-2 col-form-label">Password (optional): <span class="required">*</span></label>
                                    <div class="col-lg-10 col-sm-12 d-flex align-items-center">
                                        <input type="password" class="form-control" id="password" name="password"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <button class="btn btn-primary">Update Recipient</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection