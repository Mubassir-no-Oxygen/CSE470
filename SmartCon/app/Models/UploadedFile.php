<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id','uploader_id','original_name','path'];

    public function appointment() { return $this->belongsTo(Appointment::class); }
    public function uploader() { return $this->belongsTo(User::class, 'uploader_id'); }
}
