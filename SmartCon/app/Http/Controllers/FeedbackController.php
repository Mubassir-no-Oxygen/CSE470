<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request, Appointment $appointment) {
        $this->authorize('cancel', $appointment);
        $data = $request->validate([
            'rating'=>'required|integer|min:1|max:5',
            'comment'=>'nullable|string|max:1000'
        ]);
        Feedback::updateOrCreate(
            ['appointment_id'=>$appointment->id, 'student_id'=>$request->user()->id],
            $data
        );
        return back()->with('ok','Feedback submitted');
    }
}
