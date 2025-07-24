@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
<div class="container-fluid px-4">

    @if($activeSession)
    <div class="alert alert-danger d-flex align-items-center mb-4">
        <i class="fas fa-calendar-alt fa-2x me-3"></i>
        <div>
            <h5 class="alert-heading mb-1">Active Session</h5>
            <p class="mb-0">{{ $activeSession->name }}</p>
        </div>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-danger mb-1">
                <i class="fas fa-user-plus me-2"></i> Add New Teacher
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-danger">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>

    <div class="card border-danger shadow">
        <div class="card-header bg-danger text-white py-3">
            <h5 class="mb-0"><i class="fas fa-user-graduate me-2"></i> Teacher Information</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('teachers.store') }}" method="POST">
                @csrf

                <!-- Basic Information -->
                <h5 class="text-danger fw-bold mb-3">Basic Information</h5>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label required">First Name</label>
                        <input type="text" name="first_name" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">Last Name</label>
                        <input type="text" name="last_name" class="form-control form-control-lg" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Gender</label>
                        <select name="gender" class="form-select form-select-lg" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control form-control-lg" required>
                    </div>
                </div>

                <!-- Contact Information -->
                <h5 class="text-danger fw-bold mb-3">Contact Information</h5>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label required">Phone</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white"><i class="fas fa-phone"></i></span>
                            <input type="text" name="phone" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" name="address" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white"><i class="fas fa-city"></i></span>
                            <input type="text" name="city" class="form-control form-control-lg">
                        </div>
                    </div>
                </div>

                <!-- Guardian Information -->
                <h5 class="text-danger fw-bold mb-3">Guardian Information</h5>
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Guardian Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white"><i class="fas fa-user-shield"></i></span>
                            <input type="text" name="guardian_name" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Guardian Phone</label>
                        <div class="input-group">
                            <span class="input-group-text bg-danger text-white"><i class="fas fa-phone"></i></span>
                            <input type="text" name="guardian_phone" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Relation to Teacher</label>
                        <input type="text" name="relation_to_teacher" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Guardian Address</label>
                        <input type="text" name="guardian_address" class="form-control form-control-lg">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Guardian City</label>
                        <input type="text" name="guardian_city" class="form-control form-control-lg">
                    </div>
                </div>

                <!-- Submit -->
                <div class="d-flex justify-content-end pt-4 border-top">
                    <button type="submit" class="btn btn-danger btn-lg px-5 me-3">
                        <i class="fas fa-save me-2"></i> Save Teacher
                    </button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-lg px-5">
                        <i class="fas fa-times me-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .required:after {
        content: "*";
        color: #dc3545;
        margin-left: 4px;
    }
    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1rem;
        font-size: 1.1rem;
    }
    .border-top {
        border-top: 1px dashed #dc3545 !important;
    }
</style>
@endpush
@endsection
