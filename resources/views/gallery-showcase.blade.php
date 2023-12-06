@extends('layouts.index')
@section('title', 'Gallery Showcase')

@section('content')
<div class="container">
    <div class="p-5 text-center rounded-3 mt-5">
        <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Gallery Showcase</h1>
        <hr class="featurette-divider" />
    </div>
</div>

@foreach ($gallery_showcases as $gallery_showcase)
<div class="bg-kabarkadogs-2 marketing section-padding-top">
    <div class="container">
      <div class="row featurette">
        <div class="col-lg-6 d-flex justify-content-center justify-content-md-start">
          <img
            src="{{ asset('storage/gallery_showcase_images/' . $gallery_showcase->image) }}"
            alt="logo2"
            class="img-fluid rounded"
            width="500"
          />
        </div>
        <div class="col-lg-6">
          <h3 class="color-kabarkadogs-gold mt-3">{{ $gallery_showcase->sub_title }}</h3>
          <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
            {{ $gallery_showcase->title }}
          </h2>
          <p class="lead color-kabarkadogs mt-3">
            {{ $gallery_showcase->description }}
          </p>
        </div>
        <hr class="featurette-divider" />
      </div>
    </div>
  </div>
@endforeach  

@endsection