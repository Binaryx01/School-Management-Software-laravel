<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicSession;

class AcademicSessionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:academic_sessions,name',
        ]);

        AcademicSession::create([
            'name' => $request->name,
            'is_active' => false,
        ]);

        return redirect()->back()->with('success', 'Academic session created!');
    }

  // AcademicSessionController.php

public function activate($id)
{
    // Deactivate all
    AcademicSession::query()->update(['is_active' => false]);

    // Activate selected
    $session = AcademicSession::findOrFail($id);
    $session->is_active = true;
    $session->save();

    // Store in Laravel session
    session(['active_academic_session_id' => $session->id]);

    return redirect()->back()->with('success', 'Academic session activated and set as current.');
}

}