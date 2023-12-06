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
                            <img src="{{ asset('assets/images/profile-45x45.png') }}" alt="User" title="User" class="round" /> {{ auth()->guard('admin')->user()->name }} (Admin)
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('admin.account.edit-profile') }}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.account.change-password') }}">Change Password</a></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
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
                <li><a href="{{ route('admin.dashboard.index') }}" class="{{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                <li>
                    <a class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.add') || request()->routeIs('admin.users.view') || request()->routeIs('admin.users.edit') || request()->routeIs('admin.recipients.index') || request()->routeIs('admin.recipients.add') || request()->routeIs('admin.recipients.view') || request()->routeIs('admin.recipients.edit') || request()->routeIs('admin.admins.index') || request()->routeIs('admin.admins.add') || request()->routeIs('admin.admins.view') || request()->routeIs('admin.admins.edit') ? 'active' : '' }}" data-bs-toggle="collapse" href="#accounts-menu" role="button" aria-expanded="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.add') || request()->routeIs('admin.users.view') || request()->routeIs('admin.users.edit') || request()->routeIs('admin.recipients.index') || request()->routeIs('admin.recipients.add') || request()->routeIs('admin.recipients.view') || request()->routeIs('admin.recipients.edit') || request()->routeIs('admin.admins.index') || request()->routeIs('admin.admins.add') || request()->routeIs('admin.admins.view') || request()->routeIs('admin.admins.edit') ? 'true' : 'false' }}" aria-controls="accounts-menu"><i class="fa-solid fa-users"></i> Accounts</a>
                    <ul id="accounts-menu" class="collapse {{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.add') || request()->routeIs('admin.users.view') || request()->routeIs('admin.users.edit') || request()->routeIs('admin.recipients.index') || request()->routeIs('admin.recipients.add') || request()->routeIs('admin.recipients.view') || request()->routeIs('admin.recipients.edit') || request()->routeIs('admin.admins.index') || request()->routeIs('admin.admins.add') || request()->routeIs('admin.admins.view') || request()->routeIs('admin.admins.edit') ? 'show' : '' }}">
                        <li><a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.add') || request()->routeIs('admin.users.view') || request()->routeIs('admin.users.edit') ? 'active' : '' }}">Users</a></li>
                        <li><a href="{{ route('admin.recipients.index') }}" class="{{ request()->routeIs('admin.recipients.index') || request()->routeIs('admin.recipients.add') || request()->routeIs('admin.recipients.view') || request()->routeIs('admin.recipients.edit') ? 'active' : '' }}">Recipients</a></li>
                        <li><a href="{{ route('admin.admins.index') }}" class="{{ request()->routeIs('admin.admins.index') || request()->routeIs('admin.admins.add') || request()->routeIs('admin.admins.view') || request()->routeIs('admin.admins.edit') ? 'active' : '' }}">Admins</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.index') ? 'active' : '' }}"><i class="fa-solid fa-chart-simple"></i> Reports</a></li>
                <li><a href="{{ route('admin.about.index') }}" class="{{ request()->routeIs('admin.about.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> About</a></li>
                <li><a href="{{ route('admin.academic-calendar.index') }}" class="{{ request()->routeIs('admin.academic-calendar.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> Academic Calendar</a></li>
                <li><a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> FAQs</a></li>
                <li><a href="{{ route('admin.gallery-showcase.index') }}" class="{{ request()->routeIs('admin.gallery-showcase.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> Gallery Showcase</a></li>
                <li><a href="{{ route('admin.home.index') }}" class="{{ request()->routeIs('admin.home.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> Home</a></li>
                <li><a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> News</a></li>
                <li><a href="{{ route('admin.teacher-spotlight.index') }}" class="{{ request()->routeIs('admin.teacher-spotlight.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> Teacher Spotlight</a></li>
                <li><a href="{{ route('admin.support.index') }}" class="{{ request()->routeIs('admin.support.index') ? 'active' : '' }}"><i class="fa-solid fa-circle-info"></i> Support</a></li>
            </ul>
        </nav>
        <div id="content">
            @yield('content')
        </div>
        <footer>Tandaay High School. &copy; 2023 All Rights Reserved.</footer>
    </div>
    @yield('modal')
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
