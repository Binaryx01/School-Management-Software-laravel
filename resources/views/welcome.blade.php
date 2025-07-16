<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | School Sutra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Special Login Button Style */
        .login-btn {
            background: #fff;
            color: #dc3545;
            font-weight: bold;
            border-radius: 50px;
            padding: 8px 20px;
            box-shadow: 0 0 10px rgba(220, 53, 69, 0.5);
            transition: all 0.3s ease-in-out;
        }
        .login-btn:hover {
            background: #dc3545;
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.8);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">School Sutra</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn login-btn ms-3" href="{{route('login')}}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow-1">
        <!-- Hero Section -->
        <section class="bg-light text-center py-5">
            <div class="container">
                <h1 class="display-4">Welcome to School Sutra</h1>
                <p class="lead">Manage students, teachers, exams, fees, and more — all in one place.</p>
                <a href="#" class="btn btn-danger btn-lg mt-3">Get Started</a>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4 text-center">
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4>Student Management</h4>
                                <p>Track and manage student information efficiently.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4>Teacher Dashboard</h4>
                                <p>Assign subjects and manage class performance easily.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4>Class Routine</h4>
                                <p>Create and customize routines for different classes and sections.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4>Exam Management</h4>
                                <p>Plan, schedule, and record student exam results with ease.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4>Fee Management</h4>
                                <p>Track fee payments, dues, and generate financial reports.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h4>Library Management</h4>
                                <p>Issue, return, and manage books with a digital library system.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-danger text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2025 School Sutra. All rights reserved. Version 0.1</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
