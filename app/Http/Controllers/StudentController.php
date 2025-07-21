<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show list of students filtered by active academic session
    public function index()
    {
        $activeSessionId = session('active_academic_session_id');

        if (!$activeSessionId) {
            return redirect()->route('academic_sessions.index')
                ->with('error', 'Please activate an academic session first.');
        }

        $students = Student::with(['academicSession', 'schoolClass', 'section'])
            ->where('academic_session_id', $activeSessionId)
            ->get();

        return view('students.index', compact('students'));
    }

    // Show form to create new student
    public function create()
    {
        $activeSessionId = session('active_academic_session_id');

        if (!$activeSessionId) {
            return redirect()->route('academic_sessions.index')
                ->with('error', 'Please activate an academic session first.');
        }

        $classes = SchoolClass::where('academic_session_id', $activeSessionId)->get();
        $sections = Section::whereIn('school_class_id', $classes->pluck('id'))->get();
        $students = Student::with('academicSession')
            ->where('academic_session_id', $activeSessionId)
            ->get();

        return view('students.create', compact('students', 'classes', 'sections'));
    }

    // Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_class_id' => 'nullable|exists:school_classes,id',
            'section_id' => 'nullable|exists:sections,id',
        ]);

        $activeSessionId = session('active_academic_session_id');

        if (!$activeSessionId) {
            return redirect()->route('students.create')
                ->with('error', 'Please activate an academic session first.');
        }

        $validated['academic_session_id'] = $activeSessionId;

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }
}
