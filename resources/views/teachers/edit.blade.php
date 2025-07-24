@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@extends('layouts.app')

@section('title', 'Edit Teacher')

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
                <i class="fas fa-user-edit me-2"></i>Edit Teacher
            </h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('teachers.index') }}">Teachers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('teachers.index') }}" class="btn btn-outline-danger">
            <i class="fas fa-arrow-left me-2"></i> Back to List
        </a>
    </div>

    <!-- Edit Form -->
    <div class="card border-danger shadow">
        <div class="card-header bg-danger text-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-user-graduate me-2"></i>
                Editing: {{ $teacher->first_name }} {{ $teacher->last_name }}
            </h5>
        </div>
        
        <div class="card-body">
            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Basic Info Section -->
                <div class="mb-5">
                    <h5 class="text-danger fw-bold mb-4 d-flex align-items-center">
                        <span class="bullet bullet-dot bg-danger me-3 h-10px w-10px"></span>
                        Basic Information
                    </h5>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label required">First Name</label>
                            <input type="text" name="first_name" class="form-control form-control-lg" 
                                   value="{{ $teacher->first_name }}" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label required">Last Name</label>
                            <input type="text" name="last_name" class="form-control form-control-lg" 
                                   value="{{ $teacher->last_name }}" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label required">Gender</label>
                            <select name="gender" class="form-select form-select-lg" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ $teacher->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $teacher->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ $teacher->gender == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label required">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control form-control-lg" 
                                   value="{{ $teacher->date_of_birth }}" required>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Info Section -->
                <div class="mb-5">
                    <h5 class="text-danger fw-bold mb-4 d-flex align-items-center">
                        <span class="bullet bullet-dot bg-danger me-3 h-10px w-10px"></span>
                        Contact Information
                    </h5>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label required">Phone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" name="phone" class="form-control form-control-lg" 
                                       value="{{ $teacher->phone }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label required">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control form-control-lg" 
                                       value="{{ $teacher->email }}" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <input type="text" name="address" class="form-control form-control-lg" 
                                       value="{{ $teacher->address }}">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="fas fa-city"></i>
                                </span>
                                <input type="text" name="city" class="form-control form-control-lg" 
                                       value="{{ $teacher->city }}">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Guardian Info Section -->
                <div class="mb-4">
                    <h5 class="text-danger fw-bold mb-4 d-flex align-items-center">
                        <span class="bullet bullet-dot bg-danger me-3 h-10px w-10px"></span>
                        Guardian Information
                    </h5>
                    
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label">Guardian Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="fas fa-user-shield"></i>
                                </span>
                                <input type="text" name="guardian_name" class="form-control form-control-lg" 
                                       value="{{ $teacher->guardian_name }}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Guardian Phone</label>
                            <div class="input-group">
                                <span class="input-group-text bg-danger text-white">
                                    <i class="fas fa-phone"></i>
                                </span>
                                <input type="text" name="guardian_phone" class="form-control form-control-lg" 
                                       value="{{ $teacher->guardian_phone }}">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Relationship</label>
                            <input type="text" name="relation_to_teacher" class="form-control form-control-lg" 
                                   value="{{ $teacher->relation_to_teacher }}">
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="d-flex justify-content-end pt-6 border-top">
                    <button type="submit" class="btn btn-danger btn-lg px-6 me-3">
                        <i class="fas fa-save me-2"></i>Update Teacher
                    </button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary btn-lg px-6">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bullet {
        display: inline-block;
        border-radius: 0.35rem;
    }
    .bullet-dot {
        width: 0.5rem;
        height: 0.5rem;
    }
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