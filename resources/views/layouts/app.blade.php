<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Sutra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            height: 100vh;
            background: #fff;
            padding: 20px;
            border-right: 2px solid #dc3545;
        }
        .sidebar a {
            display: block;
            color: #dc3545;
            margin-bottom: 10px;
            text-decoration: none;
            font-weight: 500;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-danger">School Sutra</h4>
            <a href="/dashboard">Dashboard</a>
            <a href="/teachers">Teachers</a>
            <a href="#">Students</a>
            <a href="#">Classes</a>
            <a href="#">Exams</a>
        </div>

        <!-- Page Content -->
        <div class="flex-grow-1">
   <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand text-danger fw-bold">Dashboard</span>
        <div class="ms-auto">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>

            <!-- Main Content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
