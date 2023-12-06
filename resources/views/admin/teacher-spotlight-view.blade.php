
@extends('layouts.admin')
@section('title', 'About')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #b3ccf5;">
                    <!-- Assuming $teacher_spotlight is the variable passed to your view that contains the AboutContent model instance -->
                    <img src="{{ asset('storage/teacher_spotlight_images/' . $teacher_spotlight->image) }}" alt="About Image" height="300" class="mb-5 rounded">
                    <h4 class="alert-heading color-kabarkadogs">Title: {{ $teacher_spotlight->title }}</h4>
                    <p class="color-kabarkadogs">Sub Title: {{ $teacher_spotlight->sub_title }}</p>
                    <p class="color-kabarkadogs">Description: {{ $teacher_spotlight->description }}</p>
                </div>
            </div>                    
        </div>
    </div>
@endsection