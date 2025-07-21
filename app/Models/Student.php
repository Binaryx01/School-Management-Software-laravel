<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'academic_session_id',
        'school_class_id',
        'section_id',
    ];

    // Relationship to AcademicSession
    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    // Relationship to SchoolClass
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    // Relationship to Section
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
