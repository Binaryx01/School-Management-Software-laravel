<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ This line is missing
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'academic_session_id'];

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }
}
