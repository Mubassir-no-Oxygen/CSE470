<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(Request $request, Appointment $appointment) {
        $this->authorize('cancel', $appointment); // reuse access: participants or admin
        $messages = Message::where('appointment_id',$appointment->id)->orderBy('created_at','asc')->get();
        return response()->json($messages);
    }

    public function store(Request $request, Appointment $appointment) {
        $this->authorize('cancel', $appointment);

        $data = $request->validate(['content'=>'required|string|max:2000']);
        $msg = Message::create([
            'appointment_id'=>$appointment->id,
            'sender_id'=>$request->user()->id,
            'content'=>$data['content']
        ]);
        return back();
    }
}
