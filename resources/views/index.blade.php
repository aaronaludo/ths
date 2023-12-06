@extends('layouts.index')
@section('title', 'Home')

@section('content')
<div class="container">
    <div class="p-5 text-center rounded-3 mt-5">
        <h1 class="color-kabarkadogs fw-bold hero-title position-relative display-3">Home</h1>
        <hr class="featurette-divider" />
    </div>
</div>

@foreach ($homes as $home)
<div class="bg-kabarkadogs-2 marketing section-padding-top">
    <div class="container">
      <div class="row featurette">
        <div class="col-lg-6 d-flex justify-content-center justify-content-md-start">
          <img
            src="{{ asset('storage/home_images/' . $home->image) }}"
            alt="logo2"
            class="img-fluid rounded"
            width="500"
          />
        </div>
        <div class="col-lg-6">
          <h3 class="color-kabarkadogs-gold mt-3">{{ $home->sub_title }}</h3>
          <h2 class="featurette-heading fw-normal lh-1 color-kabarkadogs">
            {{ $home->title }}
          </h2>
          <p class="lead color-kabarkadogs mt-3">
            {{ $home->description }}
          </p>
        </div>
        <hr class="featurette-divider" />
      </div>
    </div>
  </div>
@endforeach  

@endsection