<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waitlist extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id','student_id','preferred_start','preferred_end','note','status'];

    public function faculty()
    {
        return $this->belongsTo(User::class, 'faculty_id');
    }
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}   

