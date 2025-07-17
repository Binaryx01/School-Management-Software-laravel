<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | School Sutra</title>
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
            /* border-right removed */
            color: #dc3545; /* Red text */
            padding-top: 60px;
        }
        .sidebar h4 {
            padding-left: 1.5rem;
            color: #dc3545;
            font-weight: 700;
        }
        .sidebar ul.nav {
            padding-left: 0;
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
            padding-top: 60px; /* To avoid navbar overlap */
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
                border-bottom: 4px solid #dc3545;
                padding-top: 10px;
            }
            .main-content {
                margin-left: 0;
                padding-top: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4>School Sutra</h4>
        <ul class="nav flex-column mt-4">
            <li><a class="nav-link" href="#">Dashboard</a></li>
            <li><a class="nav-link" href="#">Teachers</a></li>
            <li><a class="nav-link" href="#">Students</a></li>
            <li><a class="nav-link" href="#">Classes</a></li>
            <li><a class="nav-link" href="#">Exams</a></li>
            <!-- Add more here -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Navbar -->
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
            <h3 class="mb-4">Welcome, {{ session('user_email') }}</h3>
            <p class="lead">You are logged into your dashboard. Use the sidebar to access different sections of the School Sutra system.</p>
            
            <!-- Example dashboard stats -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Students</h5>
                            <p class="card-text fs-4">340</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Total Teachers</h5>
                            <p class="card-text fs-4">28</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Upcoming Exams</h5>
                            <p class="card-text fs-4">5</p>
                        </div>
                    </div>
                </div>

                 <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-danger">
                        <div class="card-body">
                            <h5 class="card-title">Notice</h5>
                            <p class="card-text fs-4">5</p>
                        </div>
                    </div>
                </div>





                
            </div>

            <!-- Add more widgets or content below -->
        </div>
    </div>

</body>
</html>
