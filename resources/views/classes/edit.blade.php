@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')
    <h3>Edit Class</h3>

    <form method="POST" action="{{ route('classes.update', $class->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Class Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $class->name }}" required>
        </div>

        <button type="submit" class="btn btn-danger">Update</button>
        <a href="{{ route('classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
