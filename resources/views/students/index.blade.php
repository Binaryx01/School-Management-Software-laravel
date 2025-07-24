@extends('layouts.app')

@section('title', 'Students List')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h3 class="text-danger"><i class="fas fa-users me-2"></i>Student Management</h3>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('students.create') }}" class="btn btn-danger">
                <i class="fas fa-plus-circle me-1"></i> Add New Student
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-danger">
        <div class="card-header bg-danger text-white">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Students List</h5>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="{{ route('students.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   class="form-control form-control-sm" placeholder="Search students...">
                            <button class="btn btn-outline-light btn-sm" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead class="table-danger">
                        <tr>
                            <th class="text-nowrap">#</th>
                            <th class="text-nowrap">Student Name</th>
                            <th class="text-nowrap">Class</th>
                            <th class="text-nowrap">Section</th>
                            <th class="text-nowrap">Phone</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $student->first_name }} {{ $student->last_name }}</strong>
                                    @if($student->father_name)
                                        <br><small class="text-muted">Father: {{ $student->father_name }}</small>
                                    @endif
                                </td>
                                <td>{{ $student->schoolClass->name ?? 'N/A' }}</td>
                                <td>{{ $student->section->name ?? 'N/A' }}</td>
                                <td>{{ $student->phone ?: 'N/A' }}</td>
                                <td>{{ $student->email ?: 'N/A' }}</td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('students.edit', $student->id) }}" 
                                           class="btn btn-outline-danger" title="Edit">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this student?')"
                                                    title="Delete">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-exclamation-circle me-2"></i> No students found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($students->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    {{ $students->withQueryString()->links() }}
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table-danger th {
        background-color: #dc3545;
        color: white;
    }
    .btn-outline-danger:hover {
        color: #fff;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }
</style>
@endpush