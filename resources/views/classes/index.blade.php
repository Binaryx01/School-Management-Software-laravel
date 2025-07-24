@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@if($activeSession)
    <div class="alert alert-info mb-4">
        <strong>Active Academic Session:</strong> {{ $activeSession->name }}
    </div>
@endif

@extends('layouts.app')

@section('title', 'Manage Classes & Sections')

@section('content')
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="m-0">Class Management</h1>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#createClassModal">
                        <i class="fas fa-plus me-2"></i>Create New Class
                    </button>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Classes</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Create Class Modal -->
        <div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="createClassModalLabel">Create New Class</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('classes.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="class_name" class="form-label">Class Name</label>
                                <input type="text" name="class_name" id="class_name" class="form-control" placeholder="e.g. Nursery, Grade 1" required>
                            </div>
                            <div class="mb-3">
                                <label for="section_name" class="form-label">Section Name <small class="text-muted">(optional)</small></label>
                                <input type="text" name="section_name" id="section_name" class="form-control" placeholder="e.g. A, B, C">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Create Class</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($classes as $class)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">{{ $class->name }}</h5>
                            <span class="badge bg-white text-danger">{{ $class->students_count ?? 0 }} students</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#editClassModal{{ $class->id }}">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('class', {{ $class->id }})">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </div>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#addSectionModal{{ $class->id }}">
                                    <i class="fas fa-plus me-1"></i>Add Section
                                </button>
                            </div>

                            @if($class->sections->count())
                                <div class="list-group list-group-flush">
                                    @foreach($class->sections as $section)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="fw-semibold">{{ $section->name }}</span>
                                                <small class="text-muted ms-2">({{ $section->students_count ?? 0 }} students)</small>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#editSectionModal{{ $section->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete('section', {{ $section->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-light text-center py-4">
                                    <i class="fas fa-folder-open fa-2x mb-3 text-muted"></i>
                                    <p class="mb-0">No sections added yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Edit Class Modal -->
                <div class="modal fade" id="editClassModal{{ $class->id }}" tabindex="-1" aria-labelledby="editClassModalLabel{{ $class->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="editClassModalLabel{{ $class->id }}">Edit Class</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('classes.update', $class->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="edit_class_name{{ $class->id }}" class="form-label">Class Name</label>
                                        <input type="text" name="name" id="edit_class_name{{ $class->id }}" class="form-control" value="{{ $class->name }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Update Class</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Add Section Modal -->
                <div class="modal fade" id="addSectionModal{{ $class->id }}" tabindex="-1" aria-labelledby="addSectionModalLabel{{ $class->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title" id="addSectionModalLabel{{ $class->id }}">Add Section to {{ $class->name }}</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="{{ route('sections.store') }}">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $class->id }}">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="section_name{{ $class->id }}" class="form-label">Section Name</label>
                                        <input type="text" name="name" id="section_name{{ $class->id }}" class="form-control" placeholder="e.g. A, B, C" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Add Section</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @foreach($class->sections as $section)
                    <!-- Edit Section Modal -->
                    <div class="modal fade" id="editSectionModal{{ $section->id }}" tabindex="-1" aria-labelledby="editSectionModalLabel{{ $section->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="editSectionModalLabel{{ $section->id }}">Edit Section</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('sections.update', $section->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_section_name{{ $section->id }}" class="form-label">Section Name</label>
                                            <input type="text" name="name" id="edit_section_name{{ $section->id }}" class="form-control" value="{{ $section->name }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Update Section</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item? This action cannot be undone.</p>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm').submit();">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(type, id) {
            let form = document.getElementById('deleteForm');
            if (type === 'class') {
                form.action = `/classes/${id}`;
            } else if (type === 'section') {
                form.action = `/sections/${id}`;
            }
            new bootstrap.Modal(document.getElementById('deleteConfirmationModal')).show();
        }
    </script>
@endpush