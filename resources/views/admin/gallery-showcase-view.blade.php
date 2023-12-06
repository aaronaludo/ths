
@extends('layouts.admin')
@section('title', 'Gallery Showcase')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-between">
                <div><h2 class="title">View</h1></div>
            </div>
            <div class="col-lg-12">
                <div class="alert" style="background: #b3ccf5;">
                    <!-- Assuming $gallery_showcase is the variable passed to your view that contains the Gallery ShowcaseContent model instance -->
                    <img src="{{ asset('storage/gallery_showcase_images/' . $gallery_showcase->image) }}" alt="Gallery Showcase Image" height="300" class="mb-5 rounded">
                    <h4 class="alert-heading color-kabarkadogs">Title: {{ $gallery_showcase->title }}</h4>
                    <p class="color-kabarkadogs">Sub Title: {{ $gallery_showcase->sub_title }}</p>
                    <p class="color-kabarkadogs">Description: {{ $gallery_showcase->description }}</p>
                </div>
            </div>                    
        </div>
    </div>
@endsection