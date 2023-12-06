
@extends('layouts.admin')
@section('title', 'News')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #b3ccf5;">
                    <!-- Assuming $new is the variable passed to your view that contains the NewsContent model instance -->
                    <img src="{{ asset('storage/new_images/' . $new->image) }}" alt="News Image" height="300" class="mb-5 rounded">
                    <h4 class="alert-heading color-kabarkadogs">Title: {{ $new->title }}</h4>
                    <p class="color-kabarkadogs">Sub Title: {{ $new->sub_title }}</p>
                    <p class="color-kabarkadogs">Description: {{ $new->description }}</p>
                </div>
            </div>                    
        </div>
    </div>
@endsection