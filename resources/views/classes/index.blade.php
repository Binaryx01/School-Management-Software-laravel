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

    <div class="row row-cols-1 row-cols-md-3 g-4">
     @foreach($classes as $class)
    @if($class->sections->count())
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $class->name }}</h5>

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
            </div>
        </div>
    @endif
@endforeach


    </div>
@endsection
