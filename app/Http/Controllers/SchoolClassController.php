<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\AcademicSession;

class SchoolClassController extends Controller
{
    // Show list of classes
    public function index()
    {
       // $classes = SchoolClass::with('sections')->get();
       //$classes = SchoolClass::with('sections')->distinct()->get();
        $classes = SchoolClass::with('sections')->get()->unique('id')->values();

        return view('classes.index', compact('classes'));
    }

    // Store new class with optional section
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

    // Show form to edit a class
    public function edit($id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    // Update class name
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $class = SchoolClass::findOrFail($id);
        $class->name = $request->name;
        $class->save();

        return redirect()->route('classes.index')->with('success', 'Class updated successfully.');
    }

    // Delete class and its sections
    public function destroy($id)
    {
        $class = SchoolClass::findOrFail($id);

        // Delete related sections (optional, or use cascading deletes)
        $class->sections()->delete();

        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class and its sections deleted successfully.');
    }
}
