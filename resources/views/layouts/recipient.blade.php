<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" />
    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="wrapper">
        <header id="header" class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid p-0">
                <div id="header-logo">
                    <div class="d-flex justify-content-center align-items-center h-100 w-100">
                        <img src="{{ asset('assets/images/logo-with-text.png') }}" alt="Mobvex"/>
                    </div>
                </div>
                <a href="#" id="button-menu"><i class="fa-solid fa-bars"></i></a>
                <a href="#" id="button-menu-close"><i class="fa-solid fa-xmark"></i></a>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/images/profile-45x45.png') }}" alt="User" title="User" class="round" /> {{ auth()->guard('recipient')->user()->name }} ({{ auth()->guard('recipient')->user()->role->name }})
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('recipient.account.edit-profile') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('recipient.account.change-password') }}">Change Password</a></li>
                            <li>
                                <form method="POST" action="{{ route('recipient.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <nav id="column-left">
            <ul id="menu">
                <li><a href="{{ route('recipient.dashboard.index') }}" class="{{ request()->routeIs('recipient.dashboard.index') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li>
                    <a class="collasped {{ request()->routeIs('recipient.track-document-reviews.index') || request()->routeIs('recipient.request-document-reviews.index') || request()->routeIs('recipient.track-document-reviews.view') || request()->routeIs('recipient.request-document-reviews.view') || request()->routeIs('recipient.track-document-reviews.qr-scanner') ? 'active' : '' }}" 
                       data-bs-toggle="collapse" href="#document-review-menu" role="button" 
                       aria-expanded="{{ request()->routeIs('recipient.track-document-reviews.index') || request()->routeIs('recipient.request-document-reviews.index') || request()->routeIs('recipient.track-document-reviews.view') || request()->routeIs('recipient.request-document-reviews.view') || request()->routeIs('recipient.track-document-reviews.qr-scanner') ? 'true' : 'false' }}" 
                       aria-controls="document-review-menu">
                        <i class="fa-solid fa-magnifying-glass"></i> Document Reviews
                    </a>
                    <ul id="document-review-menu" class="collapse {{ request()->routeIs('recipient.track-document-reviews.index') || request()->routeIs('recipient.request-document-reviews.index') || request()->routeIs('recipient.track-document-reviews.view') || request()->routeIs('recipient.request-document-reviews.view') || request()->routeIs('recipient.track-document-reviews.qr-scanner') ? 'show' : '' }}">
                        <li><a href="{{ route('recipient.track-document-reviews.index') }}" class="{{ request()->routeIs('recipient.track-document-reviews.index') || request()->routeIs('recipient.track-document-reviews.view') || request()->routeIs('recipient.track-document-reviews.qr-scanner') ? 'active' : '' }}">Tracks</a></li>
                        <li><a href="{{ route('recipient.request-document-reviews.index') }}" class="{{ request()->routeIs('recipient.request-document-reviews.index') || request()->routeIs('recipient.request-document-reviews.view') ? 'active' : '' }}">Requests</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('recipient.reports.index') }}" class="{{ request()->routeIs('recipient.reports.index') ? 'active' : '' }}"><i class="fa-solid fa-chart-simple"></i> Reports</a></li>
                <li><a href="{{ route('recipient.support.index') }}" class="{{ request()->routeIs('recipient.support.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> Support</a></li>
            </ul>
        </nav>
        <div id="content">
            @yield('content')
        </div>
        <footer>Wyrsoft Tech. &copy; 2023 All Rights Reserved.</footer>
    </div>
    @yield('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
