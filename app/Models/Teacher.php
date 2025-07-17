<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    
    protected $fillable = [
    'first_name',
    'last_name',
    'gender',
    'date_of_birth',
    'phone',
    'email',
    'address',
    'city',
    'guardian_name',
    'guardian_phone',
    'guardian_address',
    'guardian_city',
    'relation_to_teacher',
];




}
