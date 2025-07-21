@extends('layouts.app')

@section('title', 'Students List')

@section('content')
    <h3 class="mb-4">All Students</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
