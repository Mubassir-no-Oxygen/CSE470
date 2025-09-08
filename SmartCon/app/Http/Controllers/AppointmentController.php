<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Availability;
use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmed;

class AppointmentController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        if ($user->isFaculty()) {
            $appointments = Appointment::where('faculty_id',$user->id)->orderBy('start','asc')->paginate(15);
        } else {
            $appointments = Appointment::where('student_id',$user->id)->orderBy('start','asc')->paginate(15);
        }
        $faculties = User::where('role','faculty')->get();
        return view('appointments.index', compact('appointments','faculties'));
    }

    public function create(User $faculty) {
        $slots = Availability::where('faculty_id',$faculty->id)->orderBy('start','asc')->get();
        return view('appointments.create', compact('faculty','slots'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'faculty_id'=>'required|exists:users,id',
            'start'=>'required|date',
            'end'=>'required|date|after:start',
            'notes'=>'nullable|string|max:500'
        ]);
        $data['student_id'] = $request->user()->id;

        $overlap = Appointment::where('faculty_id',$data['faculty_id'])
            ->where(function($q) use ($data) {
                $q->whereBetween('start', [$data['start'],$data['end']])
                  ->orWhereBetween('end', [$data['start'],$data['end']])
                  ->orWhere(function($q2) use ($data){
                      $q2->where('start','<=',$data['start'])->where('end','>=',$data['end']);
                  });
            })->exists();

        if ($overlap) {
            // Put on waitlist
            Waitlist::create([
                'faculty_id'=>$data['faculty_id'],
                'student_id'=>$data['student_id'],
                'preferred_start'=>$data['start'],
                'preferred_end'=>$data['end'],
                'note'=>$data['notes'] ?? null,
                'status'=>'pending'
            ]);
            return back()->with('error','Slot not available. You have been added to the waitlist.');
        }

        $apt = Appointment::create($data + ['status'=>'confirmed']);

        try {
            Mail::to($request->user()->email)->send(new AppointmentConfirmed($apt));
            Mail::to(User::find($data['faculty_id'])->email)->send(new AppointmentConfirmed($apt));
        } catch (\Throwable $e) {
            // mail failure is not fatal
        }

        return redirect()->route('appointments.index')->with('ok','Appointment confirmed');
    }

    public function cancel(Request $request, Appointment $appointment) {
        $this->authorize('cancel', $appointment);
        $appointment->update(['status'=>'cancelled']);
        return back()->with('ok','Appointment cancelled');
    }

    public function reschedule(Request $request, Appointment $appointment) {
        $this->authorize('reschedule', $appointment);
        $data = $request->validate([
            'start'=>'required|date',
            'end'=>'required|date|after:start',
        ]);
        $appointment->update($data + ['status'=>'confirmed']);
        return back()->with('ok','Appointment rescheduled');
    }
}
