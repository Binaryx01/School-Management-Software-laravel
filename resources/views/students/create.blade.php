@isset($students)
    @if ($students->count())
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <!-- your table content -->
            </table>
        </div>
    @else
        <p class="mt-3 text-danger">No students found.</p>
    @endif
@endisset



@extends('layouts.app')

@section('title', 'Student Management')

@section('content')
<h3 class="mb-4">Student Management</h3>

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

<ul class="nav nav-tabs mb-4" id="studentTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link text-danger {{ request('search') ? '' : 'active' }}" id="add-tab" data-bs-toggle="tab" data-bs-target="#addStudent" type="button" role="tab">
            Add Student
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="nav-link text-danger {{ request('search') ? 'active' : '' }}" id="view-tab" data-bs-toggle="tab" data-bs-target="#viewStudents" type="button" role="tab">
            View Students
        </button>
    </li>
</ul>

<div class="tab-content" id="studentTabContent">
    {{-- Add Student Tab --}}
    <div class="tab-pane fade {{ request('search') ? '' : 'show active' }}" id="addStudent" role="tabpanel">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            {{-- Step 1: General Info --}}
            <div class="card mb-4" id="step1">
                <div class="card-header bg-danger text-white">
                    General Information
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input name="first_name" class="form-control form-control-sm" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input name="last_name" class="form-control form-control-sm" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Father's Name</label>
                        <input name="father_name" class="form-control form-control-sm" value="{{ old('father_name') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control form-control-sm" value="{{ old('dob') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select form-select-sm">
                            <option value="">-- Select --</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Class</label>
                        <select name="school_class_id" class="form-select form-select-sm">
                            <option value="">-- Select Class --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('school_class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Section</label>
                        <select name="section_id" class="form-select form-select-sm">
                            <option value="">-- Select Section --</option>
                            @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }} ({{ $section->schoolClass->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Phone</label>
                        <input name="phone" class="form-control form-control-sm" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control form-control-sm" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">City</label>
                        <input name="city" class="form-control form-control-sm" value="{{ old('city') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea name="address" rows="2" class="form-control form-control-sm">{{ old('address') }}</textarea>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-danger btn-sm" onclick="nextStep()">Next</button>
                    </div>
                </div>
            </div>

            {{-- Step 2: Guardian Info --}}
            <div class="card mb-4 d-none" id="step2">
                <div class="card-header bg-danger text-white">
                    Guardian Information
                </div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Guardian Name</label>
                        <input name="guardian_name" class="form-control form-control-sm" value="{{ old('guardian_name') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Guardian Phone</label>
                        <input name="guardian_phone" class="form-control form-control-sm" value="{{ old('guardian_phone') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Guardian City</label>
                        <input name="guardian_city" class="form-control form-control-sm" value="{{ old('guardian_city') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Relationship</label>
                        <input name="guardian_relationship" class="form-control form-control-sm" value="{{ old('guardian_relationship') }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Guardian Address</label>
                        <textarea name="guardian_address" rows="2" class="form-control form-control-sm">{{ old('guardian_address') }}</textarea>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-secondary btn-sm me-2" onclick="prevStep()">Back</button>
                        <button type="submit" class="btn btn-danger btn-sm">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- View Students Tab --}}
    <div class="tab-pane fade {{ request('search') ? 'show active' : '' }}" id="viewStudents" role="tabpanel">
        <form method="GET" action="{{ route('students.index') }}" class="mb-3">
            <div class="input-group input-group-sm">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search students...">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>

        @if ($students->count())
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                <td>{{ $student->schoolClass->name ?? 'N/A' }}</td>
                                <td>{{ $student->section->name ?? 'N/A' }}</td>
                                <td>{{ ucfirst($student->gender) }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->city }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="mt-3 text-danger">No students found.</p>
        @endif
    </div>
</div>

{{-- Step Switcher Script --}}
@push('scripts')
<script>
    function nextStep() {
        document.getElementById('step1').classList.add('d-none');
        document.getElementById('step2').classList.remove('d-none');
    }

    function prevStep() {
        document.getElementById('step2').classList.add('d-none');
        document.getElementById('step1').classList.remove('d-none');
    }
</script>
@endpush
@endsection
