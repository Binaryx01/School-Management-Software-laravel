<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // Show the edit section form
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    // Update the section name
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $section->update(['name' => $request->name]);

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    // Delete section and auto-delete class if it has no more sections
    public function destroy(Section $section)
    {
        $class = $section->schoolClass; // Get the related class

        $section->delete(); // Delete the section

        // If no more sections remain under the class, delete the class too
        if ($class->sections()->count() === 0) {
            $class->delete();
        }

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
}
