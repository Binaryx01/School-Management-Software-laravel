@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="m-0">Edit Class</h1>
                    <a href="{{ route('classes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Classes
                    </a>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('classes.index') }}">Classes</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Edit Class Details</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('classes.update', $class->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Class Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ $class->name }}" required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('classes.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-save me-2"></i>Update Class
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection