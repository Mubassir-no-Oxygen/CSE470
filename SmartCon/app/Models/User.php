<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name','email','password','role'];
    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() { return $this->role === 'admin'; }
    public function isFaculty() { return $this->role === 'faculty'; }
    public function isStudent() { return $this->role === 'student'; }

    public function availabilities() { return $this->hasMany(Availability::class, 'faculty_id'); }
    public function appointmentsAsFaculty() { return $this->hasMany(Appointment::class, 'faculty_id'); }
    public function appointmentsAsStudent() { return $this->hasMany(Appointment::class, 'student_id'); }
}
