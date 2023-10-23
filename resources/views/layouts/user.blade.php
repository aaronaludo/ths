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
    <title>@yield('title')</title>
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
                            <img src="{{ asset('assets/images/profile-45x45.png') }}" alt="User" title="User" class="round" />{{ auth()->guard('normal')->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('account.edit-profile') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('account.change-password') }}">Change Password</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
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
                <li><a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li>
                    <a class="{{ request()->routeIs('track-documents.index') || 
                        request()->routeIs('request-documents.index') || 
                        request()->routeIs('track-documents.compose') || 
                        request()->routeIs('track-documents.edit') || 
                        request()->routeIs('track-documents.view') || 
                        request()->routeIs('request-documents.add') ||
                        request()->routeIs('request-documents.edit') ||
                        request()->routeIs('request-documents.view') ? 'active' : '' }}"
                       data-bs-toggle="collapse" href="#document-menu" role="button" aria-expanded="{{ request()->routeIs('track-documents.index') || 
                       request()->routeIs('request-documents.index') || 
                       request()->routeIs('track-documents.compose') || 
                       request()->routeIs('track-documents.edit') || 
                       request()->routeIs('track-documents.view') || 
                       request()->routeIs('request-documents.add') ||
                       request()->routeIs('request-documents.edit') ||
                       request()->routeIs('request-documents.view') ? 'true' : 'false' }}"
                       aria-controls="document-menu">
                        <i class="fa-regular fa-file"></i> Documents
                    </a>
                    <ul id="document-menu" class="collapse {{ request()->routeIs('track-documents.index') || 
                        request()->routeIs('request-documents.index') || 
                        request()->routeIs('track-documents.compose') || 
                        request()->routeIs('track-documents.edit') || 
                        request()->routeIs('track-documents.view') || 
                        request()->routeIs('request-documents.add') ||
                        request()->routeIs('request-documents.edit') ||
                        request()->routeIs('request-documents.view') ? 'show' : '' }}">
                        <li><a href="{{ route('track-documents.index') }}" class="{{ request()->routeIs('track-documents.index') || request()->routeIs('track-documents.compose') || 
                            request()->routeIs('track-documents.edit') || 
                            request()->routeIs('track-documents.view')? 'active' : '' }}">Tracks</a></li>
                        <li><a href="{{ route('request-documents.index') }}" class="{{ request()->routeIs('request-documents.index') || 
                            request()->routeIs('request-documents.add') || 
                            request()->routeIs('request-documents.edit') || 
                            request()->routeIs('request-documents.view') ? 'active' : '' }}">Requests</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.index') ? 'active' : '' }}"><i class="fa-solid fa-chart-simple"></i> Reports</a></li>
                <li><a href="{{ route('support.index') }}" class="{{ request()->routeIs('support.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> Support</a></li>
            </ul>
        </nav>
        <div id="content">
            @yield('content')
        </div>
        <footer>Wyrsoft Tech. &copy; 2023 All Rights Reserved.</footer>
    </div>
    @yield('modal')
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
