@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@if($activeSession)
    <div class="alert alert-info">
        <strong>Active Academic Session:</strong> {{ $activeSession->name }}
    </div>
@endif






{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h3 class="mb-4">Welcome, {{ session('user_email') }}</h3>
    <p class="lead">You are logged into your dashboard. Use the sidebar to access different sections of the School Sutra system.</p>

    {{-- Academic Session Management --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Manage Academic Sessions</strong>
        </div>
        <div class="card-body">
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

            {{-- Create Session --}}
            <form action="{{ route('academic_sessions.store') }}" method="POST" class="row g-3 mb-3">
                @csrf
                <div class="col-auto">
                    <input type="text" name="name" class="form-control" placeholder="e.g. 2025-2026" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-success">Create Session</button>
                </div>
            </form>

            {{-- List Sessions --}}
            @php
                $sessions = \App\Models\AcademicSession::all();
            @endphp

            @if ($sessions->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Session Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sessions as $session)
                            <tr>
                                <td>{{ $session->name }}</td>
                                <td>
                                    @if ($session->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!$session->is_active)
                                        <form action="{{ route('academic_sessions.activate', $session->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary">Activate</button>
                                        </form>
                                    @else
                                        <button class="btn btn-sm btn-outline-success" disabled>Active</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No academic sessions added yet.</p>
            @endif
        </div>
    </div>

    {{-- Dashboard Cards --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Students</h5>
                    <p class="card-text fs-4">340</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Teachers</h5>
                    <p class="card-text fs-4">28</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-danger">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Exams</h5>
                    <p class="card-text fs-4">5</p>
                </div>
            </div>
        </div>
    </div>
@endsection
