@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@if($activeSession)
    <div class="alert alert-danger">
        <strong>Active Academic Session:</strong> {{ $activeSession->name }}
    </div>
@endif



@extends('layouts.app')

@section('title', 'Add Student')

@section('content')

<!-- @php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@if($activeSession)
    <div class="alert alert-info">
        <strong>Active Academic Session:</strong> {{ $activeSession->name }}
    </div>
@endif -->

<h3 class="mb-4">Add New Student</h3>

{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Error Messages --}}
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

    {{-- Student Name --}}
    <div class="mb-3">
        <label for="name" class="form-label">Student Name</label>
        <input type="text" name="name" class="form-control" required placeholder="Enter student name" value="{{ old('name') }}">
    </div>

    {{-- Class --}}
    <div class="mb-3">
        <label for="school_class_id" class="form-label">Class</label>
        <select name="school_class_id" class="form-select">
            <option value="">-- Select Class --</option>
            @foreach($classes as $class)
                <option value="{{ $class->id }}" {{ old('school_class_id') == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Section --}}
    <div class="mb-3">
        <label for="section_id" class="form-label">Section</label>
        <select name="section_id" class="form-select">
            <option value="">-- Select Section --</option>
            @foreach($sections as $section)
                <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                    {{ $section->name }} ({{ $section->schoolClass->name }})
                </option>
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
                <th>Class</th>
                <th>Section</th>
                <th>Session</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->schoolClass->name ?? 'N/A' }}</td>
                    <td>{{ $student->section->name ?? 'N/A' }}</td>
                    <td>{{ $student->academicSession->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No students found.</p>
@endif

@endsection
