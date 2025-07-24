<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
   public function index(Request $request)
{
    $activeSessionId = session('active_academic_session_id');

    if (!$activeSessionId) {
        return redirect()->route('academic_sessions.index')
            ->with('error', 'Please activate an academic session first.');
    }

    $query = Student::with(['academicSession', 'schoolClass', 'section'])
        ->where('academic_session_id', $activeSessionId);

    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%")
              ->orWhere('phone', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%");
        });
    }

    $students = $query->paginate(10); // Added pagination
    $classes = SchoolClass::where('academic_session_id', $activeSessionId)->get();
    $sections = Section::whereIn('school_class_id', $classes->pluck('id'))->get();

    return view('students.index', compact('students', 'classes', 'sections'));
}

public function create()
{
    $activeSessionId = session('active_academic_session_id');

    if (!$activeSessionId) {
        return redirect()->route('academic_sessions.index')
            ->with('error', 'Please activate an academic session first.');
    }

    $classes = SchoolClass::where('academic_session_id', $activeSessionId)->get();
    $sections = Section::whereIn('school_class_id', $classes->pluck('id'))->get();

    // Get students only for the select dropdown or other minimal needs
    $students = Student::where('academic_session_id', $activeSessionId)
        ->limit(5) // or whatever makes sense for your create form
        ->get();

    return view('students.create', compact('classes', 'sections', 'students'));
}

    public function store(Request $request)
    {
        $activeSessionId = session('active_academic_session_id');

        if (!$activeSessionId) {
            return redirect()->route('students.create')
                ->with('error', 'Please activate an academic session first.');
        }

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'school_class_id' => 'nullable|exists:school_classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:students,email',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:20',
            'guardian_city' => 'nullable|string|max:100',
            'guardian_relationship' => 'nullable|string|max:100',
            'guardian_address' => 'nullable|string',
        ]);

        $validated['academic_session_id'] = $activeSessionId;
        $validated['name'] = trim($validated['first_name'] . ' ' . $validated['last_name']);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function edit(Student $student)
    {
        $activeSessionId = session('active_academic_session_id');
        $classes = SchoolClass::where('academic_session_id', $activeSessionId)->get();
        $sections = Section::whereIn('school_class_id', $classes->pluck('id'))->get();

        return view('students.edit', compact('student', 'classes', 'sections'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // Include all other fields from store() method
        ]);

        $student->update($validated);
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}