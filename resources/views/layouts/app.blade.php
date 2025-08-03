<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <!-- <li class="nav-item">
                    <a href="{{ route('schools.create') }}" class="nav-link">
                        <i class="bi bi-plus-circle me-1"></i> Add School
                    </a>
                </li> -->
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
                <li class="nav-item">
                    <a href="{{ route('classes.index') }}" class="nav-link">
                        <i class="bi bi-journal-text me-1"></i> Manage Classes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sections.index') }}" class="nav-link">
                        <i class="bi bi-layers"></i> Manage Sections
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('students.index') }}" class="nav-link">
                        <i class="bi bi-people-fill"></i> <!-- FontAwesome icon (optional) -->
                        <span>Manage Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('teachers.index') }}"
                        class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}">
                        <i class="bi bi-person-badge-fill me-2"></i>Manage Teachers
                    </a>
                </li>

                <div class="dropdown">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="subjectDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-journal-bookmark-fill me-2"></i> Manage Subjects
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="subjectDropdown">
                            <li class="nav-item">
                                <a href="{{ route('subjects.index') }}" class="nav-link">
                                    <i class="bi bi-journal-bookmark-fill me-2"></i>
                                    Subjects
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('assign.index') }}" class="nav-link">
                                    <i class="bi bi-person-video3 me-2"></i>
                                    Assign Subjects
                                </a>
                            </li>
                        </ul>
                    </li>

                </div>
                <div class="dropdown">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="timetableDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-calendar2-week me-2"></i> Manage Timetable
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="timetableDropdown">

                            <li class="nav-item">
                                <a class="dropdown-item nav-link" href="{{ route('timetable.index') }}">
                                    <i class="bi bi-calendar-week me-2"></i> Full Week Timetable
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="dropdown-item nav-link" href="{{ route('timetables.print') }}">
                                    <i class="bi bi-calendar-day me-2"></i> Print Timetable
                                </a>
                            </li>
                        </ul>
                    </li>

                </div>

                <li class="nav-item">
                    <a href="{{ route('attendance.index') }}" class="nav-link">
                        <i class="bi bi-check-square me-2"></i> Attendance
                    </a>
                </li>
                <div class="dropdown">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="examDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-journal-text"></i> Manage Exams
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="examDropdown">

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('exams.index') }}">
                                    <i class="bi bi-journal-text"></i> {{-- Icon for Exams --}}
                                    <span>Exams</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('marks.index') }}">
                                    <i class="bi bi-pencil-square"></i> {{-- Bootstrap icon for mark entry --}}
                                    <span>Marks Entry</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('results.index') }}">
                                    <i class="bi bi-clipboard-data"></i> {{-- Bootstrap icon --}}
                                    <span>Exam Results</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </div>

                <!-- Fee Types -->
                <div class="dropdown">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="feeDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-cash-coin me-2"></i> Manage Fee
                        </a>
                        <ul class="dropdown-menu border-0 shadow" aria-labelledby="feeDropdown">

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('fee-types.index') }}">
                                    <i class="bi bi-cash-coin me-2"></i> Fee Types
                                </a>
                            </li>

                            <!-- Fee Assignments -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('fee-assignments.index') }}">
                                    <i class="bi bi-ui-checks-grid me-2"></i> Assign Fees
                                </a>
                            </li>

                            <!-- Student Fees -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('student-fees.index') }}">
                                    <i class="bi bi-receipt-cutoff me-2"></i> Fee Collection
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reports.classWiseCollection') }}">
                                    <i class="bi bi-bar-chart-line-fill me-2"></i> Class-wise Fee Collection
                                </a>
                            </li>

                        </ul>
                    </li>
                </div>

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
                    <!-- <li class="nav-item mb-2">
                        <a href="{{ route('schools.create') }}" class="nav-link">
                            <i class="bi bi-plus-circle me-1"></i> Add School
                        </a>
                    </li> -->
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
                    <li class="nav-item">
                        <a href="{{ route('classes.index') }}" class="nav-link">
                            <i class="bi bi-journal-text me-1"></i> Manage Classes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('sections.index') }}" class="nav-link">
                            <i class="bi bi-layers"></i> Manage Sections
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('students.index') }}" class="nav-link">
                            <i class="bi bi-people-fill"></i> <!-- FontAwesome icon (optional) -->
                            <span>Student Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}"
                            class="nav-link {{ request()->is('teachers*') ? 'active' : '' }}">
                            <i class="bi bi-person-badge-fill me-2"></i> Teachers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('subjects.index') }}" class="nav-link">
                            <i class="bi bi-journal-bookmark-fill me-2"></i>
                            Subjects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('assign.index') }}" class="nav-link">
                            <i class="bi bi-person-video3 me-2"></i>
                            Assign Subjects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('timetable.index') }}" class="nav-link">
                            <i class="bi bi-calendar2-week me-2"></i> Class Timetable
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('attendance.index') }}" class="nav-link">
                            <i class="bi bi-check-square me-2"></i> Attendance
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
                    <button class="btn d-lg-none me-2" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#sidebarMenu">
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
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/class.js') }}"></script> {{-- We'll create this file next --}}
    <script src="{{ asset('js/section.js') }}"></script>
    <script src="{{ asset('js/student.js') }}"></script>
    <script src="{{ asset('js/teacher.js') }}"></script>
    <script src="{{ asset('js/subject.js') }}"></script>
    <script src="{{ asset('js/assign-subject.js') }}"></script>
    <script src="{{ asset('js/timetable.js') }}"></script>
    <script src="{{ asset('js/attendance.js') }}"></script>
    <script src="{{ asset('js/exam.js') }}"></script>
    <script src="{{ asset('js/marks.js') }}"></script>




</body>

</html>