<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets2/css/carousel.css') }}" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg shadow" id="navbar">
      <div class="container">
        <a class="navbar-brand" href="index.html">Tandaay High School</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarTogglerDemo02"
          aria-controls="navbarTogglerDemo02"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('about') }}">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('news') }}">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('faqs') }}">FAQs</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Pages
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('academic-calendar') }}">Academic Calendar</a></li>
                <li><a class="dropdown-item" href="{{ route('teacher-spotlight') }}">Teacher Spotlight</a></li>
                <li><a class="dropdown-item" href="{{ route('gallery-showcase') }}">Gallery Showcase</a></li>
              </ul>
            </li>
          </ul>
          <div class="d-flex">
            <button class="btn btn-kabarkadogs me-2"><a href="{{ route('login') }}" class="text-decoration-none text-white">Login</a></button>
          </div>
        </div>
      </div>
    </nav>

    @yield('content')

    <footer class="pt-5 bg-kabarkadogs-2">
        <div style="background: #dbdce3">
          <div
            class="container d-flex flex-column flex-sm-row justify-content-between py-4 border-top"
          >
            <p class="color-kabarkadogs">© Tandaay High School 2023</p>
            <!-- <ul class="list-unstyled d-flex">
              <li class="ms-3">
                <a class="link-body-emphasis" href="#"
                  ><i
                    class="fa-brands fa-facebook color-kabarkadogs"
                    style="font-size: 30px"
                  ></i
                ></a>
              </li>
              <li class="ms-3">
                <a class="link-body-emphasis" href="#"
                  ><i
                    class="fa-brands fa-instagram color-kabarkadogs"
                    style="font-size: 30px"
                  ></i
                ></a>
              </li>
              <li class="ms-3">
                <a class="link-body-emphasis" href="#"
                  ><i
                    class="fa-brands fa-twitter color-kabarkadogs"
                    style="font-size: 30px"
                  ></i
                ></a>
              </li>
            </ul> -->
          </div>
        </div>
      </footer>
      <button
        onclick="scrollToTop()"
        id="scrollToTopBtn"
        title="Scroll to Top"
        class="rounded-circle"
      >
        <i class="fa-solid fa-arrow-up" style="font-size: 20px"></i>
      </button>
      <script src="{{ asset('assets2/js/script.js') }}"></script>
      <script src="{{ asset('assets2/js/bootstrap.bundle.min.js') }}"></script>
    </body>
  </html>
  