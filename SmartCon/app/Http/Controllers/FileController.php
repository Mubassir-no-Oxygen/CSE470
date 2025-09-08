<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request, Appointment $appointment) {
        $this->authorize('cancel', $appointment);
        $request->validate(['file'=>'required|file|max:5120']);
        $path = $request->file('file')->store('appointments');
        UploadedFile::create([
            'appointment_id'=>$appointment->id,
            'uploader_id'=>$request->user()->id,
            'original_name'=>$request->file('file')->getClientOriginalName(),
            'path'=>$path
        ]);
        return back()->with('ok','File uploaded');
    }

    public function download(UploadedFile $file) {
        return Storage::download($file->path, $file->original_name);
    }
}
