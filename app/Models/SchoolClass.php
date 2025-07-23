<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name', 'academic_session_id'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

        public function students()
    {
    // Students directly assigned to this class (if applicable)
    return $this->hasMany(Student::class);  
    }



    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }


    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }
}
