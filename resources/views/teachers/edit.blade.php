@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-danger fw-bold mb-4">✏️ Edit Teacher</h3>

    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" class="card shadow-sm p-4">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="first_name" class="form-control" value="{{ $teacher->first_name }}" placeholder="First Name" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="last_name" class="form-control" value="{{ $teacher->last_name }}" placeholder="Last Name" required>
            </div>
            <div class="col-md-2">
                <select name="gender" class="form-select" required>
                    <option value="" disabled>Gender</option>
                    @foreach(['Male', 'Female', 'Other'] as $g)
                        <option value="{{ $g }}" {{ $teacher->gender == $g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="date_of_birth" class="form-control" value="{{ $teacher->date_of_birth }}" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="phone" class="form-control" value="{{ $teacher->phone }}" placeholder="Phone" required>
            </div>

            <div class="col-md-4">
                <input type="email" name="email" class="form-control" value="{{ $teacher->email }}" placeholder="Email" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="address" class="form-control" value="{{ $teacher->address }}" placeholder="Address">
            </div>
            <div class="col-md-4">
                <input type="text" name="city" class="form-control" value="{{ $teacher->city }}" placeholder="City">
            </div>

            <div class="col-md-3">
                <input type="text" name="guardian_name" class="form-control" value="{{ $teacher->guardian_name }}" placeholder="Guardian Name">
            </div>
            <div class="col-md-3">
                <input type="text" name="guardian_phone" class="form-control" value="{{ $teacher->guardian_phone }}" placeholder="Guardian Phone">
            </div>
            <div class="col-md-3">
                <input type="text" name="guardian_address" class="form-control" value="{{ $teacher->guardian_address }}" placeholder="Guardian Address">
            </div>
            <div class="col-md-3">
                <input type="text" name="guardian_city" class="form-control" value="{{ $teacher->guardian_city }}" placeholder="Guardian City">
            </div>
            <div class="col-md-3">
                <input type="text" name="relation_to_teacher" class="form-control" value="{{ $teacher->relation_to_teacher }}" placeholder="Relation">
            </div>

            <div class="col-md-3 d-grid">
                <button type="submit" class="btn btn-danger">Update Teacher</button>
            </div>
            <div class="col-md-3 d-grid">
                <a href="{{ route('teachers.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
