<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Dashboard') | School Sutra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
        }
        .sidebar h4 {
            padding-left: 1.5rem;
            color: #dc3545;
            font-weight: 700;
        }
        .sidebar .nav-link {
            padding: 12px 20px;
            display: block;
            color: #dc3545;
            font-weight: 500;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar .nav-link:hover {
            background-color: #fde0e0;
            color: #a71d2a;
            border-radius: 6px;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 60px;
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

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>School Sutra</h4>
        <ul class="nav flex-column mt-4">
            <li><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
            <li><a class="nav-link" href="{{ route('teachers.index') }}">Teachers</a></li>
            <li><a class="nav-link" href="{{route('students.create')}}">Students</a></li>

            <li><a class="nav-link" href="#">Classes</a></li>
            <li><a class="nav-link" href="#">Exams</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Dashboard</a>
                <div class="ms-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
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
