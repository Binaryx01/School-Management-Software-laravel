


@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@if($activeSession)
    <div class="alert alert-info">
        <strong>Active Academic Session:</strong> {{ $activeSession->name }}
    </div>
@endif


@extends('layouts.app')

@section('title', 'Manage Classes & Sections')

@section('content')
    <h3 class="mb-4">Create New Class & Section</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('classes.store') }}" class="mb-5">
        @csrf
        <div class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="class_name" class="form-label fw-semibold">Class Name</label>
                <input type="text" name="class_name" id="class_name" class="form-control" placeholder="e.g. Nursery, Grade 1" required>
            </div>

            <div class="col-md-5">
                <label for="section_name" class="form-label fw-semibold">Section Name <small class="text-muted">(optional)</small></label>
                <input type="text" name="section_name" id="section_name" class="form-control" placeholder="e.g. A, B, C">
            </div>

            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-danger btn-block">Add</button>
            </div>
        </div>
    </form>

    <hr>

    <h4 class="mb-4">All Classes and Sections</h4>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($classes as $class)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <!-- Class title and +Add Section button -->
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h5 class="mb-0">{{ $class->name }}</h5>
                                <!-- Class Edit/Delete -->
                                <div class="mt-2">
                                    <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>

                                    <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this class and all its sections?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </div>
                            </div>

                            <!-- + Add Section Button -->
                            <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#addSectionModal{{ $class->id }}">
                                + Add Section
                            </button>
                        </div>

                        <!-- Sections List -->
                        @if($class->sections->count())
                            <ul class="list-group">
                                @foreach($class->sections as $section)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $section->name }}
                                        <span>
                                            <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <form action="{{ route('sections.destroy', $section->id) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this section?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mt-3">No sections added yet.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Add Section Modal -->
            <div class="modal fade" id="addSectionModal{{ $class->id }}" tabindex="-1" aria-labelledby="addSectionModalLabel{{ $class->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('sections.store') }}">
                        @csrf
                        <input type="hidden" name="class_id" value="{{ $class->id }}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSectionModalLabel{{ $class->id }}">Add Section to {{ $class->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label for="section_name" class="form-label">Section Name</label>
                                <input type="text" name="name" class="form-control" placeholder="e.g. A, B, C" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Add Section</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
