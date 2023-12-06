
@extends('layouts.admin')
@section('title', 'Academic Calendar')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #b3ccf5;">
                    <!-- Assuming $academic_calendar is the variable passed to your view that contains the Academic CalendarContent model instance -->
                    <img src="{{ asset('storage/academic_calendar_images/' . $academic_calendar->image) }}" alt="Academic Calendar Image" height="300" class="mb-5 rounded">
                    <h4 class="alert-heading color-kabarkadogs">Title: {{ $academic_calendar->title }}</h4>
                    <p class="color-kabarkadogs">Sub Title: {{ $academic_calendar->sub_title }}</p>
                    <p class="color-kabarkadogs">Description: {{ $academic_calendar->description }}</p>
                </div>
            </div>                    
        </div>
    </div>
@endsection