<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id','student_id','start','end','status','notes','availability_id'];

    public function faculty() { return $this->belongsTo(User::class, 'faculty_id'); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function messages() { return $this->hasMany(Message::class); }
    public function files() { return $this->hasMany(UploadedFile::class); }
    public function feedback() { return $this->hasOne(Feedback::class); }
}
