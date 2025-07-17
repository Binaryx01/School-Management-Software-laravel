<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // ✅ Correct import
use App\Models\Teacher;

class TeacherController extends Controller
{
     public function index()
    {
    $teachers = Teacher::orderBy('first_name')->paginate(10); // Adjust 10 as needed
    return view('teachers.index', compact('teachers'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:teachers,email',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:50',
            'guardian_name' => 'nullable|string|max:100',
            'guardian_phone' => 'nullable|string|max:20',
            'guardian_address' => 'nullable|string',
            'guardian_city' => 'nullable|string|max:50',
            'relation_to_teacher' => 'nullable|string|max:50',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function destroy($id)
    {
        Teacher::destroy($id);
        return redirect()->route('teachers.index')->with('success', 'Teacher removed successfully!');
    }

    public function edit($id)
{
    $teacher = Teacher::findOrFail($id);
    return view('teachers.edit', compact('teacher'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'gender' => 'required|in:Male,Female,Other',
        'date_of_birth' => 'required|date',
        'phone' => 'required|string|max:20',
        'email' => "required|email|unique:teachers,email,$id",
        'address' => 'nullable|string',
        'city' => 'nullable|string|max:50',
        'guardian_name' => 'nullable|string|max:100',
        'guardian_phone' => 'nullable|string|max:20',
        'guardian_address' => 'nullable|string',
        'guardian_city' => 'nullable|string|max:50',
        'relation_to_teacher' => 'nullable|string|max:50',
    ]);

    Teacher::where('id', $id)->update($validated);

    return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
}






}
