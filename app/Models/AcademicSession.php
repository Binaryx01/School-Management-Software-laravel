<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSession extends Model
{

    protected $table = 'academic_sessions';

    protected $fillable = ['name', 'is_active'];


    public function students()
{
    return $this->hasMany(Student::class);
}

    
}
