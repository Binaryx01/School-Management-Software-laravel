@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-danger fw-bold mb-4">👩‍🏫 Manage Teachers</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Add Teacher Form -->
    <div class="accordion mb-5" id="teacherFormAccordion">
        <div class="accordion-item shadow-sm border-0">
            <h2 class="accordion-header">
                <button class="accordion-button bg-danger text-white fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#addTeacherForm">
                    ➕ Add New Teacher
                </button>
            </h2>
            <div id="addTeacherForm" class="accordion-collapse collapse show" data-bs-parent="#teacherFormAccordion">
                <div class="accordion-body bg-light">
                    <form action="{{ route('teachers.store') }}" method="POST">
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
                                <button type="submit" class="btn btn-danger">Add Teacher</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- List of Teachers -->
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white fw-semibold">📋 Teacher List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="teachersTable" class="table table-striped table-hover align-middle text-center">
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
                            <td>{{ $teacher->date_of_birth }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>{{ $teacher->email }}</td>
                            <td>{{ $teacher->address }}</td>
                            <td>{{ $teacher->city }}</td>
                            <td>{{ $teacher->guardian_name }}</td>
                            <td>{{ $teacher->guardian_phone }}</td>
                            <td>{{ $teacher->guardian_address }}</td>
                            <td>{{ $teacher->guardian_city }}</td>
                            <td>{{ $teacher->relation_to_teacher }}</td>
                                                            <td class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form method="POST" action="{{ route('teachers.destroy', $teacher->id) }}" onsubmit="return confirm('Are you sure you want to delete this teacher?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                    </form>
                                </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="13" class="text-center text-muted py-3">No teachers found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#teachersTable').DataTable({
            responsive: true,
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                searchPlaceholder: "Search teachers..."
            }
        });
    });
</script>
@endpush
