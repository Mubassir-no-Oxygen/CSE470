<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['code','title','faculty_id'];

    public function faculty() { return $this->belongsTo(User::class, 'faculty_id'); }
}
