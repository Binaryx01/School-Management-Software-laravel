<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\AcademicSession;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with('sections')->get();
        return view('classes.index', compact('classes'));
    }

    public function store(Request $request)
{
    $request->validate([
        'class_name' => 'required|string|max:255',
        'section_name' => 'nullable|string|max:255',
    ]);

    $activeSessionId = session('active_academic_session_id');

    if (!$activeSessionId) {
        return redirect()->route('academic_sessions.index')
            ->with('error', 'Please activate an academic session first.');
    }

    $class = SchoolClass::create([
        'name' => $request->class_name,
        'academic_session_id' => $activeSessionId,
    ]);

    if ($request->filled('section_name')) {
        $class->sections()->create([
            'name' => $request->section_name,
        ]);
    }

    return back()->with('success', 'Class and section created successfully.');
}
}
