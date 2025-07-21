@php
    $activeSession = \App\Models\AcademicSession::where('is_active', true)->first();
@endphp

@if($activeSession)
    <div class="alert alert-danger">
        <strong>Active Academic Session:</strong> {{ $activeSession->name }}
    </div>
@endif





@extends('layouts.app')
            
            @section('content')
            
            {{-- Create Session --}}
            <form action="{{ route('academic_sessions.store') }}" method="POST" class="row g-3 mb-3">
                @csrf
                <div class="col-auto">
                    <input type="text" name="name" class="form-control" placeholder="e.g. 2025-2026" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-danger">Create Session</button>
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
                                        <span class="badge bg-danger">Active</span>
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

    @endsection