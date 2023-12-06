@extends('layouts.admin')
@section('title', 'About')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between">
            <div><h2 class="title">Add</h1></div>
        </div>
        <div class="col-lg-12">
            <div class="box">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('admin.academic-calendar.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="image" class="col-sm-12 col-lg-2 col-form-label">Image: <span class="required">*</span></label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="file" class="form-control" id="image" name="image"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="sub_title" class="col-sm-12 col-lg-2 col-form-label">Sub Title: <span class="required">*</span></label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="sub_title" name="sub_title"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="title" class="col-sm-12 col-lg-2 col-form-label">Title: <span class="required">*</span></label>
                                <div class="col-lg-10 col-sm-12">
                                    <input type="text" class="form-control" id="title" name="title"/>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="col-sm-12 col-lg-2 col-form-label">Description: <span class="required">*</span></label>
                                <div class="col-lg-10 col-sm-12">
                                    <textarea class="form-control" id="description" name="description" rows="7"></textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-5 mb-4">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection