@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@extends('layouts.app')

@section('title', 'Teacher Management')

@section('content')
<div class="container-fluid px-4">
    <!-- Session Alert -->
    @if($activeSession)
    <div class="alert alert-danger d-flex align-items-center mb-4">
        <i class="fas fa-calendar-alt fa-2x me-3"></i>
        <div>
            <h5 class="alert-heading mb-1">Active Session</h5>
            <p class="mb-0">{{ $activeSession->name }}</p>
        </div>
    </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-danger mb-1">
                <i class="fas fa-chalkboard-teacher me-2"></i>Teacher Management
            </h1>
            <p class="text-muted mb-0">Manage all teacher records and information</p>
        </div>
        <a href="{{ route('teachers.create') }}" class="btn btn-danger btn-lg px-4">
            <i class="fas fa-plus me-2"></i> Add Teacher
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle fa-2x me-3"></i>
            <div>
                <h5 class="mb-1">Success!</h5>
                <p class="mb-0">{{ session('success') }}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Search Card -->
    <div class="card border-danger mb-4 shadow">
        <div class="card-header bg-danger text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-search me-2"></i>Search Teachers
            </h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('teachers.index') }}">
                <div class="input-group input-group-lg">
                    <input type="text" name="search" class="form-control form-control-lg" 
                           placeholder="Search by name, email or phone..." 
                           value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">
                        <i class="fas fa-search me-2"></i> Search
                    </button>
                    @if(request('search'))
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-danger">
                        <i class="fas fa-times me-2"></i> Clear
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Teachers Table -->
    <div class="card border-danger shadow">
        <div class="card-header bg-danger text-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list-ol me-2"></i>Teacher Directory
            </h5>
            <span class="badge bg-white text-danger fs-6">
                {{ $teachers->total() }} {{ Str::plural('Teacher', $teachers->total()) }}
            </span>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-danger">
                        <tr>
                            <th class="ps-4">Teacher</th>
                            <th>Contact</th>
                            <th>Details</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $teacher)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-3">
                                        <span class="symbol-label bg-danger bg-opacity-10 text-danger fs-3 fw-bold">
                                            {{ substr($teacher->first_name, 0, 1) }}{{ substr($teacher->last_name, 0, 1) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-bold">{{ $teacher->first_name }} {{ $teacher->last_name }}</h6>
                                        <div class="text-muted">
                                            <i class="fas fa-{{ strtolower($teacher->gender) == 'male' ? 'male' : 'female' }} me-1"></i>
                                            {{ $teacher->gender }} | 
                                            {{ \Carbon\Carbon::parse($teacher->date_of_birth)->age }} years
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="tel:{{ $teacher->phone }}" class="text-dark text-hover-danger mb-1">
                                        <i class="fas fa-phone me-2"></i>{{ $teacher->phone }}
                                    </a>
                                    <a href="mailto:{{ $teacher->email }}" class="text-dark text-hover-danger">
                                        <i class="fas fa-envelope me-2"></i>{{ $teacher->email }}
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="mb-1">
                                        <i class="fas fa-map-marker-alt me-2 text-danger"></i>{{ $teacher->city }}
                                    </span>
                                    @if($teacher->guardian_name)
                                    <span>
                                        <i class="fas fa-user-shield me-2 text-danger"></i>{{ $teacher->guardian_name }}
                                    </span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('teachers.edit', $teacher->id) }}" 
                                       class="btn btn-sm btn-outline-danger px-3" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger px-3"
                                                data-bs-toggle="tooltip"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this teacher?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    <a href="#" 
                                       class="btn btn-sm btn-outline-secondary px-3"
                                       data-bs-toggle="tooltip"
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Teachers Found</h5>
                                    <a href="{{ route('teachers.create') }}" class="btn btn-danger mt-3">
                                        <i class="fas fa-plus me-2"></i>Add First Teacher
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($teachers->hasPages())
        <div class="card-footer bg-danger bg-opacity-10">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Showing {{ $teachers->firstItem() }} to {{ $teachers->lastItem() }} of {{ $teachers->total() }} entries
                </div>
                <div>
                    {{ $teachers->withQueryString()->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .symbol {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.475rem;
    }
    .symbol-50px {
        width: 50px;
        height: 50px;
    }
    .symbol-label {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        width: 100%;
        height: 100%;
    }
    .text-hover-danger:hover {
        color: #dc3545 !important;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(220, 53, 69, 0.05) !important;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection