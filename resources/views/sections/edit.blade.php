@extends('layouts.app')

@section('title', 'Edit Section')

@section('content')
    <h3>Edit Section</h3>

    <form action="{{ route('sections.update', $section) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Section Name</label>
            <input type="text" name="name" value="{{ $section->name }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Section</button>
    </form>
@endsection
