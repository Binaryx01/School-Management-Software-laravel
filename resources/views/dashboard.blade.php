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
    <h3 class="mb-4">Welcome, {{ session('user_email'), }} set the session first</h3>
    <p class="lead">You are logged into your dashboard. Use the sidebar to access different sections of the School Sutra system.</p>

   


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
