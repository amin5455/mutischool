<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - {{ config('app.name', 'MultiSchool') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Keep for Laravel --}}
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script> -->
</head>
<body class="bg-light">
    <div class="d-flex" style="min-height: 100vh;">

    <!-- Static Sidebar for Desktop -->
<aside class="bg-white border-end shadow-sm p-3 d-none d-lg-block" style="width: 250px;">
    <h4 class="mb-4">🏫 MultiSchool</h4>
    <ul class="nav flex-column">
        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a href="{{ route('schools.create') }}" class="nav-link">
                    <i class="bi bi-plus-circle me-1"></i> Add School
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.create') }}" class="nav-link">
                    <i class="bi bi-person-plus me-1"></i> Add User
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="bi bi-people-fill me-1"></i> View Users
                </a>
            </li>

        @endif
    </ul>
</aside>

        <!-- Sidebar -->
<!-- Sidebar as Bootstrap Offcanvas -->
<div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">🏫 MultiSchool</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-3">
        <ul class="nav flex-column">
            @if(Auth::user()->role === 'admin')
                <li class="nav-item mb-2">
                    <a href="{{ route('schools.create') }}" class="nav-link">
                        <i class="bi bi-plus-circle me-1"></i> Add School
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.create') }}" class="nav-link">
                        <i class="bi bi-person-plus me-1"></i> Add User
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="bi bi-people-fill me-1"></i> View Users
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>




        <!-- Content Area -->
        <div class="flex-grow-1">
            <!-- Top Navbar -->
<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm px-4">
    <div class="container-fluid">
        <!-- Sidebar Burger Icon for Mobile -->
        <button class="btn d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu">
            <i class="bi bi-list fs-4"></i>
        </button>

        <!-- Dashboard Title -->
        <span class="navbar-brand fw-semibold">Dashboard</span>

        <!-- Right: Always Visible User Dropdown -->
        @auth
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @endauth
    </div>
</nav>


 <!-- Page Content -->
  <main>
            @yield('content')
 </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
