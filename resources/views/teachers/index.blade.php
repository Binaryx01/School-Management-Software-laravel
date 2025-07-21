@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <h3 class="text-danger fw-bold mb-4 text-center">👩‍🏫 Manage Teachers</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <style>
        /* Custom red pagination */
        .pagination .page-link {
            color: white;
            background-color: #dc3545;
            border-color: #dc3545;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .pagination .page-link:hover {
            background-color: #bb2d3b;
            border-color: #bb2d3b;
            color: #fff;
        }
        .pagination .page-item.active .page-link {
            background-color: #a71d2a;
            border-color: #a71d2a;
            color: #fff;
        }
        .pagination .page-item.disabled .page-link {
            background-color: #f8d7da;
            border-color: #f5c2c7;
            color: #842029;
        }

        /* Table hover effect */
        table.table-hover tbody tr:hover {
            background-color: #ffe6e6;
        }

        /* Form card */
        .form-card {
            background-color: #fff6f6;
            border: 1px solid #dc3545;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(220, 53, 69, 0.15);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Buttons */
        .btn-outline-primary:hover {
            background-color: #dc3545;
            color: white !important;
            border-color: #dc3545 !important;
        }

        .btn-outline-danger:hover {
            background-color: #a71d2a;
            color: white !important;
            border-color: #a71d2a !important;
        }

        /* Form inputs spacing */
        .form-control, .form-select {
            box-shadow: none;
            border-color: #dc3545;
            transition: border-color 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #a71d2a;
            box-shadow: 0 0 5px rgba(167, 29, 42, 0.5);
        }

        /* Responsive adjustments */
        @media (max-width: 575.98px) {
            .d-flex.gap-1.justify-content-center {
                flex-direction: column;
                gap: 0.5rem;
            }
            .d-flex.gap-1.justify-content-center form {
                width: 100%;
            }
        }
    </style>

    <!-- Add Teacher Form -->
    <div class="form-card">
        <h5 class="text-danger fw-semibold mb-3">➕ Add New Teacher</h5>
        <form action="{{ route('teachers.store') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="col-md-2">
                    <select name="gender" class="form-select" required>
                        <option value="" selected disabled>Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" name="date_of_birth" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                </div>
                <div class="col-md-4">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="address" class="form-control" placeholder="Address">
                </div>
                <div class="col-md-4">
                    <input type="text" name="city" class="form-control" placeholder="City">
                </div>
                <div class="col-md-3">
                    <input type="text" name="guardian_name" class="form-control" placeholder="Guardian Name">
                </div>
                <div class="col-md-3">
                    <input type="text" name="guardian_phone" class="form-control" placeholder="Guardian Phone">
                </div>
                <div class="col-md-3">
                    <input type="text" name="guardian_address" class="form-control" placeholder="Guardian Address">
                </div>
                <div class="col-md-3">
                    <input type="text" name="guardian_city" class="form-control" placeholder="Guardian City">
                </div>
                <div class="col-md-3">
                    <input type="text" name="relation_to_teacher" class="form-control" placeholder="Relation">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-danger fw-semibold">Add Teacher</button>
                </div>
            </div>
        </form>
    </div>

    <!-- List of Teachers -->
    <div class="card shadow-sm border-danger">
        <div class="card-header bg-danger text-white fw-semibold fs-5">📋 Teacher List</div>
        <div class="card-body p-0">

            <form method="GET" action="{{ route('teachers.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search teachers..." value="{{ request('search') }}">
            <button class="btn btn-outline-danger" type="submit">Search</button>
            @if(request('search'))
            <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </div>
        </form>






            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>DOB</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Guardian</th>
                            <th>G. Phone</th>
                            <th>G. Address</th>
                            <th>G. City</th>
                            <th>Relation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $teacher)
                        <tr>
                            <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                            <td>{{ $teacher->gender }}</td>
                            <td>{{ \Carbon\Carbon::parse($teacher->date_of_birth)->format('d M, Y') }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->address }}</td>
                            <td>{{ $teacher->city }}</td>
                            <td>{{ $teacher->guardian_name }}</td>
                            <td>{{ $teacher->guardian_phone }}</td>
                            <td>{{ $teacher->guardian_address }}</td>
                            <td>{{ $teacher->guardian_city }}</td>
                            <td>{{ $teacher->relation_to_teacher }}</td>
                            <td class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form method="POST" action="{{ route('teachers.destroy', $teacher->id) }}" onsubmit="return confirm('Are you sure?')" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center text-muted py-4">No teachers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center my-4">
                    {{ $teachers->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
