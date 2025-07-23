<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'father_name',
        'dob',
        'gender',
        'school_class_id',
        'section_id',
        'phone',
        'email',
        'city',
        'address',
        'guardian_name',
        'guardian_phone',
        'guardian_city',
        'guardian_relationship',
        'guardian_address',
        'academic_session_id',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }
}
