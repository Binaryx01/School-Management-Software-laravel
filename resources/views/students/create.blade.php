@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
    <h3 class="mb-4">Add New Student</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Add Student Form --}}
    <form action="{{ route('students.store') }}" method="POST" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Student Name</label>
            <input type="text" name="name" class="form-control" required placeholder="Enter student name">
        </div>

        <div class="mb-3">
            <label for="academic_session_id" class="form-label">Academic Session</label>
            <select name="academic_session_id" class="form-select" required>
                <option value="">-- Select Academic Session --</option>
                @foreach(\App\Models\AcademicSession::all() as $session)
                    <option value="{{ $session->id }}">{{ $session->name }}{{ $session->is_active ? ' (Active)' : '' }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>

    {{-- Students List --}}
    <h3 class="mb-4">Students List</h3>

    @if ($students->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Academic Session</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->academicSession->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No students found.</p>
    @endif
@endsection
