<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard') | School Sutra</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <style>
        body {
            background-color: #fff0f0;
        }
        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: white;
            color: #dc3545;
            padding-top: 60px;
            overflow-y: auto;
        }
        .sidebar h4 {
            padding-left: 1.5rem;
            color: #dc3545;
            font-weight: 700;
            margin-top: 20px;
        }
        .sidebar .nav-link {
            padding: 12px 20px;
            display: block;
            color: #dc3545;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
            white-space: nowrap;
        }
        .sidebar .nav-link:hover {
            background-color: #fde0e0;
            color: #a71d2a;
            border-radius: 6px;
            text-decoration: none;
        }
        .sidebar .nav-link.active {
            background-color: #a71d2a; /* Dark red */
            color: #fff !important;
            border-radius: 6px;
            font-weight: 700;
        }

        .main-content {
            margin-left: 200px;
            padding-top: 60px;
            min-height: 100vh;
        }

        .navbar-custom {
            background-color: #dc3545;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .btn {
            color: white;
        }
        .navbar-custom .btn:hover {
            background-color: #fff;
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding-top: 10px;
            }
            .main-content {
                margin-left: 0;
                padding-top: 20px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h4>School Sutra</h4>

        <ul class="nav flex-column mt-4">
            <li>
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('academic_sessions.*') ? 'active' : '' }}" href="{{ route('academic_sessions.index') }}">Sessions</a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('teachers.*') ? 'active' : '' }}" href="{{ route('teachers.index') }}">Teachers</a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">Students</a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('classes.*') ? 'active' : '' }}" href="{{ route('classes.index') }}">Classes</a>
            </li>
            <li>
                <a class="nav-link {{ request()->routeIs('exams.*') ? 'active' : '' }}" href="#">Exams</a>
            </li>
        </ul>
    </div>

    {{-- Active Session Badge --}}
    @php
        $activeSessionId = session('active_academic_session_id');
        $activeSession = null;
        if ($activeSessionId) {
            $activeSession = \App\Models\AcademicSession::find($activeSessionId);
        } else {
            $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
            if ($activeSession) {
                session(['active_academic_session_id' => $activeSession->id]);
            }
        }
    @endphp

    @if ($activeSession)
        <div class="text-end me-3 position-fixed" style="right: 0; top: 10px; z-index: 1050;">
            <span class="badge bg-danger fs-6 px-3 py-2" style="font-weight: 600;">
                Active Session: {{ $activeSession->name }}
            </span>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
                <div class="ms-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container py-5">
            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
